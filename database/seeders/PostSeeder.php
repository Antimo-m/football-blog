<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $categories = Category::all();
        $teams = Team::all();

        $azioni = [
            'vince',
            'perde',
            'domina',
            'convince',
            'fatica',
            'pareggia',
            'travolge',
        ];

        for ($i = 0; $i < 20; $i++) {

            $category = $categories->random();
            $team = $teams->random();
            $azione = $faker->randomElement($azioni);

            
            if ($category->name === 'News') {
                $title = $team->name . ' ' . $azione . ' nella partita di oggi';
            } elseif ($category->name === 'Analisi') {
                $title = 'Analisi: ' . $team->name . ' e la sua prestazione recente';
            } else { // Calciomercato
                $title = 'Calciomercato: ' . $team->name . ' vicino a un nuovo acquisto';
            }

            $baseSlug = Str::slug($title);
            $count = Post::where('slug', 'LIKE', "{$baseSlug}%")->count();
            $slug = $count ? "{$baseSlug}-{$count}" : $baseSlug;

            $post = Post::create([
                'title' => $title,
                'slug' => $slug,
                'content' => $faker->paragraphs(3, true),
                'image' => null,
                'category_id' => $category->id
            ]);
            $post->teams()->attach(
                $teams->random(rand(1, min(3, $teams->count())))->pluck('id')
            );
        }
    }

}