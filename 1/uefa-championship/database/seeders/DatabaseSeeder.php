<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\Teams;
use App\Models\Week;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'id' => 1,
                'name' => 'MU',
                'strenght' => 75,
            ],
            [
                'id' => 2,
                'name'=>'Liverpool',
                'strenght'=>80,
            ],
            [
                'id' => 3,
                'name'=>'Chelsea',
                'strenght'=>81,
            ],
            [
                'id' => 4,
                'name'=>'Arsenal',
                'strenght'=>70,
            ],
        ];
        Teams::insert($teams);

        $weeks = [];
        for ($i = 1;  $i <= ((count($teams) - 1) * 2); $i++) {
            $weeks[]= [
                'number' => $i,
                'played' => 0,
                'season' => date('Y', strtotime('-1 year') . '/' . date('y'))
            ];
        }
        Week::insert($weeks);

        $league = [];
        foreach ($teams as $team) {
            $league[] = ['team_id'=>$team['id']];
        }
        League::insert($league);
    }
}
