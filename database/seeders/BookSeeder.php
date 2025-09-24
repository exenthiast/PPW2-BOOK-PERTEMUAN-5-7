<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Book::create([
                'judul' => fake()->sentence(3),
                'pengarang' => fake()->name(),
                'harga' => fake()->numberBetween(10000, 50000),
                'tgl_terbit' => fake()->date(),
            ]);
        }
    }
}
