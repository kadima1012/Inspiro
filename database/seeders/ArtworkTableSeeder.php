<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artwork;
use App\Models\Artist;
use App\Models\ArtworkType;

class ArtworkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $artists = Artist::all();

        // Check if there are artists
        if ($artists->isEmpty()) {
            $this->command->info('No artists found to populate the "artworks" table.');
            return;
        }

        $artworkTypes = ArtworkType::all();

        // Check if there are artwork types
        if ($artworkTypes->isEmpty()) {
            $this->command->info('No artwork types found to populate the "artworks" table.');
            return;
        }

        // Create artworks for each artist with coherent artwork types
        $artists->each(function ($artist) use ($artworkTypes) {
            // Create 5 artworks for each artist
            for ($i = 1; $i <= 5; $i++) {
                Artwork::create([
                    'idArtist' => $artist->idArtist,
                    'idArtworkType' => $artworkTypes->random()->idArtworkType,
                    'art_Title' => 'Artwork ' . $i . ' by ' . $artist->artist_name,
                    'art_Description' => 'Description for Artwork ' . $i,
                    'art_creation_date' => now(),
                    'art_Visible' => true,
                    'art_Status' => 'Active',
                    'filepath' => 'path/to/artwork/' . $i . '.jpg',
                    'art_quantity' => rand(1, 100), 
                ]);
            }
        });

        $this->command->info('Seeder for the "artworks" table has been run successfully!');
    }
}
