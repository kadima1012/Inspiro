<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\ShopList;
use App\Models\Order;
use App\Models\OrderArtwork;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;


class AdminController extends Controller
{
    public function update(Request $request, $entityType)
    {
        $id = $request->input('id');

        switch ($entityType) {
            case 'user':
                $entity = User::findOrFail($id);
                $entity->user_first_name = $request->input('user_first_name');
                $entity->user_last_name = $request->input('user_last_name');
                $entity->user_username = $request->input('user_username');
                $entity->email = $request->input('email');
                break;

            case 'artist':
                $entity = Artist::findOrFail($id);
                $entity->artist_first_name = $request->input('artist_first_name');
                $entity->artist_last_name = $request->input('artist_last_name');
                $entity->artist_description = $request->input('artist_description');
                $entity->artist_experience = $request->input('artist_experience');
                break;

            case 'artwork':
                $entity = Artwork::findOrFail($id);
                $entity->art_Title = $request->input('art_Title');
                $entity->art_Description = $request->input('art_Description');
                $entity->art_creation_date = $request->input('art_creation_date');
                $entity->art_Visible = $request->has('art_Visible') ? true : false;
                $entity->art_Status = $request->input('art_Status');
                break;

            case 'shoplist':
                    $idArt = $request->input('idArt');
                    $idArtist = $request->input('idArtist');
                    $entity = Shoplist::where('idArt', $idArt)->where('idArtist', $idArtist)->firstOrFail();
                    $entity->quantity_for_sale = $request->input('quantity_for_sale');
                    $entity->item_price = $request->input('item_price');
                    break;

            case 'order':
                    $entity = Order::findOrFail($id);
                    $entity->order_status = $request->input('order_status');
                    $entity->order_details = $request->input('order_details');
                    break;

            default:
                return redirect()->back()->with('error', 'Unknown entity type: ' . $entityType . '.');
        }

        $entity->save();

        return redirect()->back()->with('success', ucfirst($entityType) . ' updated successfully.');
    }

    public function delete($entityType, $id)
    {
        try {
            switch ($entityType) {

                case 'user':
                    $user = User::findOrFail($id);
                    $artistId = Artist::findIdByUserId($id);

                    if ($artistId) {
                        Artwork::deleteArtworkByArtist($artistId);

                        Artist::deleteByUserId($id);
                    }

                    $rolesDeleted = DB::table('model_has_roles')->where('model_id', $id)->delete();
                    if ($rolesDeleted === 0) {
                        Log::error('Failed to delete roles for user ID: ' . $id);
                        return response()->json(['success' => false, 'message' => 'Failed to delete roles.']);
                    }

                    $user->delete();
                    break;

                case 'artist':
                        $artistId = $id;

                        $artist=Artist::where('idArtist', $artistId)->firstOrFail();
                        $user=User::where('idUser', $artist->idUser)->firstOrFail();
                        $user->assignRole('user');

                        Artwork::deleteArtworkByArtist($artistId);

                        Artist::findOrFail($artistId)->delete();
                        break;

                case 'artwork':

                    $artId = $id;

                    $orderArtworks = OrderArtwork::findByArtId($artId);

                    foreach ($orderArtworks as $orderArtwork) {
                        $orderId = $orderArtwork->idOrder;


                        Order::cancelOrder($orderId);

                    }


                    /*
                    if ($orderArtworks->isEmpty()) {

                        Artwork::markAsDeleted($artId);
                    } else {

                        Artwork::markAsDeleted($artId);
                    }
                    */

                    Artwork::where('idArt', $artId)->delete();

                    break;

                case 'shoplist':
                    ShopList::findOrFail($id)->delete();
                    break;

                case 'order':
                    Order::findOrFail($id)->delete();
                    break;

                default:
                    return response()->json(['success' => false, 'message' => 'Unknown entity typeq.']);
            }

            return response()->json(['success' => true, 'message' => ucfirst($entityType) . ' deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function updateArtworkStatus(Request $request, $artworkId)
    {

        $artwork = Artwork::find($artworkId);

        if (!$artwork) {
            return response()->json(['success' => false, 'message' => 'Artwork not found.'], 404);
        }

        $artwork->art_Status = $request->input('art_Status', 'Pending');

        $artwork->save();

        return response()->json(['success' => true, 'message' => 'Artwork status updated successfully.']);
    }
}
