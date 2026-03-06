<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderArtwork;
use App\Models\ShopList;

class OrderArtworkTableSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();

        if ($orders->isEmpty()) {
            $this->command->info('No orders found to create order-artwork relationships.');
            return;
        }

        $shopListItems = ShopList::all();

        if ($shopListItems->isEmpty()) {
            $this->command->info('No shop list items found to create order-artwork relationships.');
            return;
        }

        $orders->each(function ($order) use ($shopListItems) {
            $artistItems = $shopListItems->where('idArtist', $order->idArtist);

            if ($artistItems->isEmpty()) {
                return;
            }

            $count = min($artistItems->count(), rand(1, 3));
            $selectedItems = $artistItems->random($count);

            if (!$selectedItems instanceof \Illuminate\Support\Collection) {
                $selectedItems = collect([$selectedItems]);
            }

            $selectedItems->each(function ($shopItem) use ($order) {
                $maxQty = max(1, $shopItem->quantity_for_sale);

                OrderArtwork::firstOrCreate(
                    [
                        'idArt' => $shopItem->idArt,
                        'idOrder' => $order->idOrder,
                    ],
                    [
                        'quantity_to_order' => rand(1, min($maxQty, 3)),
                    ]
                );
            });
        });

        $this->command->info('Seeded order-artwork relationships successfully.');
    }
}
