<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            'Juventus',
            'Inter',
            'Milan',
            'Napoli',
            'Roma',
            'Lazio'
        ];

        foreach ($teams as $team) {
            Team::create([
                'name' => $team
            ]);
        }
    }
}
