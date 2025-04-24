<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pastikan BooksTableSeeder sudah dibuat
        if (class_exists(BooksTableSeeder::class)) {
            $this->call(BooksTableSeeder::class);
        } else {
            // Fallback: Buat data buku langsung jika seeder tidak ada
            Book::create([
                'title' => 'Sample Book',
                'author' => 'Sample Author',
                'genre' => 'fiction',
                'type' => 'novel',
                'sales' => 1000,
                'average_rating' => 4.0,
                'ratings_count' => 100,
                'reviews_count' => 20
            ]);
        }

        // Buat user test
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password') // Tambahkan password
        ]);

        // Tambahkan user dummy lainnya jika perlu
        User::factory(5)->create();
    }
}