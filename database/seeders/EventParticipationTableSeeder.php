<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventParticipationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('event_participation')->insert([
            [
                'idUser' => 1,
                'IdEvents' => 1,
                'participation_status' => 'Exhibiting',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idUser' => 2,
                'IdEvents' => 1,
                'participation_status' => 'Visiting',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idUser' => 3,
                'IdEvents' => 2,
                'participation_status' => 'Exhibiting',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idUser' => 4,
                'IdEvents' => 2,
                'participation_status' => 'Visiting',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idUser' => 5,
                'IdEvents' => 3,
                'participation_status' => 'Exhibiting',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'idUser' => 1,
                'IdEvents' => 3,
                'participation_status' => 'Visiting',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
