<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArtworkType;

class ArtworkTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $artworkTypes = [
            'Painting',
            'Sculpture',
            'Photography',
            'Drawing',
            'Digital Art',
        ];

        foreach ($artworkTypes as $type) {
            ArtworkType::create([
                'type_name' => $type,
            ]);
        }

        $this->command->info('Seeder for the "artwork_types" table has been run successfully!');
    }
}
