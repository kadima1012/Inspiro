<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Artwork;
use App\Models\Order;
use App\Models\OrderArtwork;
use App\Models\ShopList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrdersController extends Controller
{
    public function index(): View
    {
        $userId = auth()->id();

        $orders = Order::where('idUser', $userId)
            ->where(function ($query) {
                $query->where('order_status', '!=', Order::STATUS_IN_CART)
                    ->orWhereNull('order_status');
            })
            ->with(['artworks' => function ($query) {
                $query->select('artwork.idArt', 'art_Title', 'art_Description', 'art_quantity', 'quantity_to_order', 'filepath');
            }])
            ->get();

        return view('dashboard.orders', ['orders' => $orders]);
    }

    public function showBasket(): View
    {
        $userId = auth()->id();

        $orders = Order::where('idUser', $userId)
            ->where('order_status', Order::STATUS_IN_CART)
            ->with(['artworks' => function ($query) {
                $query->select('artwork.idArt', 'art_Title', 'art_Description', 'art_quantity', 'quantity_to_order', 'filepath');
            }])
            ->get();

        return view('dashboard.basket', ['orders' => $orders]);
    }

    public function showConfirmAddToBasket(int $idArt): View
    {
        $artwork = Artwork::findOrFail($idArt);

        return view('dashboard.confirm_add_to_basket', compact('artwork'));
    }

    public function confirmAddToBasket(StoreOrderRequest $request): RedirectResponse
    {
        $idArt = $request->validated('idArt');
        $quantity = (int) $request->validated('quantity');
        $idArtist = Artwork::where('idArt', $idArt)->firstOrFail()->idArtist;
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to login to add items to basket.');
        }

        return DB::transaction(function () use ($user, $idArtist, $idArt, $quantity) {
            $order = Order::where('idUser', $user->idUser)
                ->where('idArtist', $idArtist)
                ->where('order_status', Order::STATUS_IN_CART)
                ->first();

            if (!$order) {
                $order = Order::create([
                    'idUser' => $user->idUser,
                    'idArtist' => $idArtist,
                    'order_status' => Order::STATUS_IN_CART,
                    'order_details' => 'Artwork added to basket',
                ]);
            }

            $orderArtwork = OrderArtwork::where('idOrder', $order->idOrder)
                ->where('idArt', $idArt)
                ->first();

            if ($orderArtwork) {
                OrderArtwork::updateOrderArtwork($idArt, $order->idOrder, $quantity);
            } else {
                OrderArtwork::create([
                    'idOrder' => $order->idOrder,
                    'idArt' => $idArt,
                    'quantity_to_order' => $quantity,
                ]);
            }

            ShopList::where('idArt', (int) $idArt)->decrement('quantity_for_sale', $quantity);

            return redirect()->route('shop')->with('success', 'Artwork added to basket successfully.');
        });
    }

    public function cancelAddToBasket(Request $request): RedirectResponse
    {
        $idArt = $request->input('idArt');
        $userId = auth()->id();

        return DB::transaction(function () use ($idArt, $userId) {
            $order = Order::where('idUser', $userId)
                ->where('order_status', Order::STATUS_IN_CART)
                ->first();

            $item = OrderArtwork::where('idOrder', $order->idOrder)
                ->where('idArt', $idArt)
                ->firstOrFail();

            $quantity = (int) $item->quantity_to_order;
            $item->delete();

            ShopList::where('idArt', (int) $idArt)->increment('quantity_for_sale', $quantity);

            $items = OrderArtwork::where('idOrder', $order->idOrder)->get();

            if ($items->isEmpty()) {
                $order->delete();
            }

            return redirect()->route('basket')->with('success', 'Order canceled successfully.');
        });
    }

    public function confirmOrder(Request $request): RedirectResponse
    {
        $userId = auth()->id();

        $order = Order::where('idUser', $userId)
            ->where('idOrder', $request->input('idOrder'))
            ->where('order_status', Order::STATUS_IN_CART)
            ->first();

        if ($order) {
            $order->order_status = Order::STATUS_ACTIVE;
            $order->order_details = 'Order confirmed';
            $order->save();

            return redirect()->route('basket')->with('success', 'Order confirmed successfully.');
        }

        return redirect()->route('basket')->with('error', 'No orders to confirm.');
    }

    public function sent(Request $request): RedirectResponse
    {
        $idOrder = $request->input('idOrder');

        $order = Order::where('idOrder', $idOrder)
            ->where('order_status', Order::STATUS_ACTIVE)
            ->first();

        if ($order) {
            $order->order_status = Order::STATUS_SENT;
            $order->order_details = 'Order sent';
            $order->save();

            return redirect()->route('sale')->with('success', 'Order sent successfully.');
        }

        return redirect()->route('sale')->with('error', 'Order cannot be sent.');
    }

    public function received(Request $request): RedirectResponse
    {
        $idOrder = $request->input('idOrder');

        $order = Order::where('idOrder', $idOrder)
            ->where('order_status', Order::STATUS_SENT)
            ->first();

        if ($order) {
            $order->order_status = Order::STATUS_RECEIVED;
            $order->order_details = 'Order received';
            $order->save();

            return redirect()->route('orders')->with('success', 'Order received successfully.');
        }

        return redirect()->route('orders')->with('error', 'Order cannot be received.');
    }
}
