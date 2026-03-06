<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\ShopList;

class ShopListTableSeeder extends Seeder
{
    public function run(): void
    {
        $artists = Artist::with('artworks')->get();

        if ($artists->isEmpty()) {
            $this->command->info('No artists found to populate the "shop_list" table.');
            return;
        }

        foreach ($artists as $artist) {
            $artworks = $artist->artworks;

            if ($artworks->count() < 3) {
                continue;
            }

            $forSale = $artworks->random(min(3, $artworks->count()));

            foreach ($forSale as $artwork) {
                $maxQty = max(1, $artwork->art_quantity);

                ShopList::updateOrCreate(
                    [
                        'idArt' => $artwork->idArt,
                        'idArtist' => $artist->idArtist,
                    ],
                    [
                        'item_price' => rand(25, 500) + (rand(0, 99) / 100),
                        'quantity_for_sale' => rand(1, min($maxQty, 5)),
                    ]
                );
            }
        }

        $this->command->info('Seeded shop list items successfully.');
    }
}
