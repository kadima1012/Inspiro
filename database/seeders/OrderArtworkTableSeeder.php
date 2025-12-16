<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Artwork;
use App\Models\OrderArtwork;
use App\Models\ShopList;

class OrderArtworkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $orders = Order::all();

        // Check if there are orders
        if ($orders->isEmpty()) {
            $this->command->info('No orders found to create order-artwork relationships.');
            return;
        }

        $shopListItems = ShopList::all();

        // Check if there are shop list items
        if ($shopListItems->isEmpty()) {
            $this->command->info('No shop list items found to create order-artwork relationships.');
            return;
        }

        $orders->each(function ($order) use ($shopListItems) {
            $selectedShopListItems = $shopListItems->random(rand(1, 5));

            $selectedShopListItems->each(function ($shopListItem) use ($order) {
                $quantityToOrder = rand(1, $shopListItem->quantity_for_sale);

                if ($order->id) {
                    OrderArtwork::firstOrCreate([
                        'idArt' => $shopListItem->idArt,
                        'idOrder' => $order->id,
                    ], ['quantity_to_order' => $quantityToOrder]);
                }
            });
        });

        $this->command->info('Seeder for the "order_artwork" table has been run successfully!');
    }
}
