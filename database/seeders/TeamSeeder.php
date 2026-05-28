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

        $palette = [
            '#000000', // Juventus
            '#0055A4', // Inter
            '#FB090B', // Milan
            '#00AEEF', // Napoli
            '#8E1F2F', // Roma
            '#87CEEB', // Lazio
        ];

        foreach ($teams as $index => $team) {
            Team::create([
                'name' => $team,
                'color' => $palette[$index % count($palette)] 
            ]);
        }
    }
}
