<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artwork;
use App\Models\Artist;
use App\Models\ArtworkType;

class ArtworkTableSeeder extends Seeder
{
    public function run(): void
    {
        $artists = Artist::all();

        if ($artists->isEmpty()) {
            $this->command->info('No artists found to populate the "artwork" table.');
            return;
        }

        $artworkTypes = ArtworkType::all();

        if ($artworkTypes->isEmpty()) {
            $this->command->info('No artwork types found to populate the "artwork" table.');
            return;
        }

        $artworkNames = [
            'Whispers of Dawn', 'Eternal Horizon', 'Silent Echoes',
            'Crimson Memories', 'Golden Reverie', 'Midnight Bloom',
            'Fractured Light', 'Velvet Shadows', 'Azure Dreams',
            'Dancing Embers', 'Frozen Melody', 'Sapphire Tide',
            'Amber Solstice', 'Ivory Cascade', 'Obsidian Mirror',
        ];

        $descriptions = [
            'A contemplative piece exploring the boundaries between light and shadow.',
            'An abstract composition inspired by the rhythms of nature.',
            'A vibrant exploration of color and texture that evokes deep emotion.',
            'This piece captures the fleeting beauty of a transitional moment.',
            'A bold statement on the relationship between space and form.',
        ];

        $artists->each(function ($artist) use ($artworkTypes, $artworkNames, $descriptions) {
            for ($i = 0; $i < 5; $i++) {
                $name = $artworkNames[array_rand($artworkNames)];

                Artwork::create([
                    'idArtist' => $artist->idArtist,
                    'idArtworkType' => $artworkTypes->random()->idArtworkType,
                    'art_Title' => $name,
                    'art_Description' => $descriptions[array_rand($descriptions)],
                    'art_creation_date' => now()->subDays(rand(30, 365)),
                    'art_Visible' => true,
                    'art_Status' => 'Active',
                    'filepath' => 'artworks/painting' . rand(1, 5) . '.jpg',
                    'art_quantity' => rand(1, 20),
                ]);
            }
        });

        $this->command->info('Seeded ' . ($artists->count() * 5) . ' artworks successfully.');
    }
}
