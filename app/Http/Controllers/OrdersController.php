<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Artwork;
use App\Models\OrderArtwork;
use App\Models\ShopList;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;



class OrdersController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Obținem doar comenzile cu statusul "in cart" și încărcăm relația cu lucrările de artă
        $orders = Order::where('idUser', $userId)
                        ->where('order_status', '!=', 'in cart')->orWhereNull('order_status')
                        ->with(['artworks' => function ($query) {
                            $query->select('artwork.idArt', 'art_Title', 'art_Description', 'art_quantity', 'quantity_to_order', 'filepath');
                        }])
                        ->get();

        return view('dashboard.orders', ['orders' => $orders]);
    }

    public function showBasket()
    {
        $userId = auth()->id();

        // Obținem doar comenzile cu statusul "in cart" și încărcăm relația cu lucrările de artă
        $orders = Order::where('idUser', $userId)
                        ->where('order_status', 'in cart')
                        ->with(['artworks' => function ($query) {
                            $query->select('artwork.idArt', 'art_Title', 'art_Description', 'art_quantity', 'quantity_to_order', 'filepath');
                        }])
                        ->get();

        return view('dashboard.basket', ['orders' => $orders]);
    }

    public function showConfirmAddToBasket($idArt)
    {
        $artwork = Artwork::findOrFail($idArt);
        return view('dashboard.confirm_add_to_basket', compact('artwork'));
    }


    public function confirmAddToBasket(Request $request)
    {
        $idArt = $request->input('idArt');
        $idArtist = Artwork::where('idArt', $idArt)->firstOrFail()->idArtist;
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to login to add items to basket.');
        }

        $order = Order::where('idUser', $user->idUser)
                    ->where('idArtist', $idArtist)
                    ->where('order_status', 'in cart')
                    ->first();

        if (!$order) {
            $order = Order::create([
                'idUser' => $user->idUser,
                'idArtist' => $idArtist,
                'order_status' => 'in cart',
                'order_details' => 'Artwork added to basket'
            ]);
        }

        $quantity = $request->input('quantity');

        $orderArtwork = OrderArtwork::where('idOrder', $order->idOrder)
                                    ->where('idArt', $idArt)
                                    ->first();

        if ($orderArtwork) {
            OrderArtwork::updateOrderArtwork($idArt, $order->idOrder, $quantity); // schimbat ordinea parametrilor
        } else {
            OrderArtwork::create([
                'idOrder' => $order->idOrder,
                'idArt' => $idArt,
                'quantity_to_order' => $quantity,
            ]);
        }

        $idArt = (int) $idArt; // Cast $idArt to an integer

        ShopList::where('idArt', $idArt)->update(['quantity_for_sale' => DB::raw("quantity_for_sale - $quantity")]);

        return redirect()->route('shop')->with('success', 'Artwork added to basket successfully.');
    }

    public function cancelAddToBasket (Request $request)
    {
        $idArt=$request->input('idArt');
        $userId = auth()->id();

        $order = Order::where('idUser', $userId)
                      ->where('order_status', 'in cart')
                      ->first();

        $item = OrderArtwork::where('idOrder', $order->idOrder)->where('idArt', $idArt)->firstOrFail();

        $quantity=$item->quantity_to_order;

        $item->delete();

        $idArt = (int) $idArt; // Cast $idArt to an integer

        ShopList::where('idArt', $idArt)->update(['quantity_for_sale' => DB::raw("quantity_for_sale + $quantity")]);

        $items = OrderArtwork::where('idOrder', $order->idOrder)->get();

        if($items->empty()){
            $order->delete();
        }

        return redirect()->route('basket')->with('success', 'Order canceled successfully.');
    }

    public function confirmOrder(Request $request)
    {
        $userId = auth()->id();

        // Găsim comanda cu status "in cart" pentru utilizatorul autentificat
        $order = Order::where('idUser', $userId)
                      ->where('idOrder', $request->input('idOrder'))
                      ->where('order_status', 'in cart')
                      ->first();

        if ($order) {
            $order->order_status = 'Active';
            $order->order_details = 'Order confirmed';
            $order->save();

            return redirect()->route('basket')->with('success', 'Order confirmed successfully.');
        }

        return redirect()->route('basket')->with('error', 'No orders to confirm.');
    }

    public function sent(Request $request){
        $idOrder=$request->input('idOrder');
        $userId = auth()->id();

        $order = Order::where('idOrder', $idOrder)
                      ->where('order_status', 'Active')
                      ->first();

        if ($order) {
            $order->order_status = 'Sent';
            $order->order_details = 'Order confirmed';
            $order->save();

            return redirect()->route('sale')->with('success', 'Order sent successfully.');
        }

        return redirect()->route('sale')->with('error', 'Order cannot be sent.');
    }

    public function received(Request $request){
        $idOrder=$request->input('idOrder');
        $userId = auth()->id();

        $order = Order::where('idOrder', $idOrder)
                      ->where('order_status', 'Sent')
                      ->first();

        if ($order) {
            $order->order_status = 'Received';
            $order->order_details = 'Order confirmed';
            $order->save();

            return redirect()->route('orders')->with('success', 'Order received successfully.');
        }

        return redirect()->route('orders')->with('error', 'Order cannot be received.');
    }
}
