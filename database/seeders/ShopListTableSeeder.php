<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artwork;
use App\Models\Artist;
use App\Models\ShopList;

class ShopListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $artists = Artist::all();

        // Check if there are artists
        if ($artists->isEmpty()) {
            $this->command->info('No artists found to populate the "shop_list" table.');
            return;
        }

        foreach ($artists as $artist) {
            $artworks = $artist->artworks->random(4);

            foreach ($artworks as $artwork) {
                $price = rand(50, 500);

                $quantityForSale = rand(1, min($artwork->art_quantity, 10)); 

                ShopList::updateOrCreate(
                    [
                        'idArt' => $artwork->idArt,
                        'idArtist' => $artist->idArtist,
                    ],
                    [
                        'item_price' => $price,
                        'quantity_for_sale' => $quantityForSale,
                    ]
                );
            }
        }

        $this->command->info('Seeder for the "shop_list" table has been run successfully!');
    }
}
