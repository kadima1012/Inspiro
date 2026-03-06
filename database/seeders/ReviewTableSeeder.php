<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Artwork;

class ReviewTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $artworks = Artwork::where('art_Status', 'Active')->get();

        if ($users->isEmpty() || $artworks->isEmpty()) {
            $this->command->info('No users or artworks found to create reviews.');
            return;
        }

        $comments = [
            'Absolutely stunning piece! The colors are breathtaking.',
            'Very creative work, I love the attention to detail.',
            'This artwork really speaks to me. Beautiful composition.',
            'Impressive technique and wonderful use of light.',
            'A masterful creation that evokes deep emotions.',
            'The texture and depth in this piece are remarkable.',
            'Such a unique perspective, truly inspiring work.',
            'I could stare at this for hours. Simply magnificent.',
        ];

        // Create 15 random reviews
        for ($i = 0; $i < 15; $i++) {
            $user = $users->random();
            $artwork = $artworks->random();

            Review::firstOrCreate(
                [
                    'idUser' => $user->idUser,
                    'idArtwork' => $artwork->idArt,
                ],
                [
                    'review_score' => rand(3, 5),
                    'review_comment' => $comments[array_rand($comments)],
                ]
            );
        }

        $this->command->info('Seeded reviews successfully.');
    }
}
