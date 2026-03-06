<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUpdateRequest;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Order;
use App\Models\OrderArtwork;
use App\Models\ShopList;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function update(AdminUpdateRequest $request, string $entityType): RedirectResponse
    {
        $validated = $request->validated();
        $id = $validated['id'] ?? null;

        switch ($entityType) {
            case 'user':
                $entity = User::findOrFail($id);
                $entity->user_first_name = $validated['user_first_name'];
                $entity->user_last_name = $validated['user_last_name'];
                $entity->user_username = $validated['user_username'];
                $entity->email = $validated['email'];
                break;

            case 'artist':
                $entity = Artist::findOrFail($id);
                $entity->artist_first_name = $validated['artist_first_name'];
                $entity->artist_last_name = $validated['artist_last_name'];
                $entity->artist_description = $validated['artist_description'];
                $entity->artist_experience = $validated['artist_experience'];
                break;

            case 'artwork':
                $entity = Artwork::findOrFail($id);
                $entity->art_Title = $validated['art_Title'];
                $entity->art_Description = $validated['art_Description'];
                $entity->art_creation_date = $validated['art_creation_date'];
                $entity->art_Visible = $request->has('art_Visible');
                $entity->art_Status = $validated['art_Status'];
                break;

            case 'shoplist':
                $entity = ShopList::where('idArt', $validated['idArt'])
                    ->where('idArtist', $validated['idArtist'])
                    ->firstOrFail();
                $entity->quantity_for_sale = $validated['quantity_for_sale'];
                $entity->item_price = $validated['item_price'];
                break;

            case 'order':
                $entity = Order::findOrFail($id);
                $entity->order_status = $validated['order_status'];
                $entity->order_details = $validated['order_details'];
                break;

            default:
                return redirect()->back()->with('error', "Unknown entity type: {$entityType}.");
        }

        $entity->save();

        return redirect()->back()->with('success', ucfirst($entityType) . ' updated successfully.');
    }

    public function delete(string $entityType, int $id): JsonResponse
    {
        try {
            DB::transaction(function () use ($entityType, $id) {
                switch ($entityType) {
                    case 'user':
                        $user = User::findOrFail($id);
                        $artistId = Artist::findIdByUserId($id);

                        if ($artistId) {
                            Artwork::deleteArtworkByArtist($artistId);
                            Artist::deleteByUserId($id);
                        }

                        DB::table('model_has_roles')->where('model_id', $id)->delete();
                        $user->delete();
                        break;

                    case 'artist':
                        $artist = Artist::where('idArtist', $id)->firstOrFail();
                        $user = User::where('idUser', $artist->idUser)->firstOrFail();
                        $user->assignRole('user');

                        Artwork::deleteArtworkByArtist($id);
                        $artist->delete();
                        break;

                    case 'artwork':
                        $orderArtworks = OrderArtwork::findByArtId($id);

                        foreach ($orderArtworks as $orderArtwork) {
                            Order::cancelOrder($orderArtwork->idOrder);
                        }

                        Artwork::where('idArt', $id)->delete();
                        break;

                    case 'shoplist':
                        ShopList::findOrFail($id)->delete();
                        break;

                    case 'order':
                        Order::findOrFail($id)->delete();
                        break;

                    default:
                        throw new \InvalidArgumentException("Unknown entity type.");
                }
            });

            return response()->json([
                'success' => true,
                'message' => ucfirst($entityType) . ' deleted successfully.',
            ]);
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ]);
        }
    }

    public function updateArtworkStatus(Request $request, int $artworkId): JsonResponse
    {
        $artwork = Artwork::find($artworkId);

        if (!$artwork) {
            return response()->json(['success' => false, 'message' => 'Artwork not found.'], 404);
        }

        $request->validate([
            'art_Status' => 'required|string|in:Pending,Active,Declined',
        ]);

        $artwork->art_Status = $request->input('art_Status', 'Pending');
        $artwork->save();

        return response()->json(['success' => true, 'message' => 'Artwork status updated successfully.']);
    }
}
