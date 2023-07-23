<?php

namespace Database\Seeders;

use App\Models\BookGenre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookGenre::create(
            [
                'name' => 'Ação',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
        BookGenre::create(
            [
                'name' => 'Aventura',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
        BookGenre::create(
            [
                'name' => 'Romance',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }
}
