<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        $books = [
            // Fiction - Novel
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'genre' => 'fiction',
                'type' => 'novel',
                'sales' => 4500,
                'average_rating' => 4.8,
                'ratings_count' => 1200,
                'reviews_count' => 350
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'genre' => 'fiction',
                'type' => 'novel',
                'sales' => 3800,
                'average_rating' => 4.7,
                'ratings_count' => 950,
                'reviews_count' => 280
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'genre' => 'fiction',
                'type' => 'novel',
                'sales' => 3200,
                'average_rating' => 4.5,
                'ratings_count' => 850,
                'reviews_count' => 220
            ],

            // Science - Textbook
            [
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'genre' => 'science',
                'type' => 'textbook',
                'sales' => 2800,
                'average_rating' => 4.6,
                'ratings_count' => 750,
                'reviews_count' => 180
            ],
            [
                'title' => 'Cosmos',
                'author' => 'Carl Sagan',
                'genre' => 'science',
                'type' => 'textbook',
                'sales' => 2500,
                'average_rating' => 4.7,
                'ratings_count' => 680,
                'reviews_count' => 150
            ],

            // Fantasy - Novel
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'genre' => 'fantasy',
                'type' => 'novel',
                'sales' => 4200,
                'average_rating' => 4.8,
                'ratings_count' => 1100,
                'reviews_count' => 320
            ],
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'genre' => 'fantasy',
                'type' => 'novel',
                'sales' => 5000,
                'average_rating' => 4.9,
                'ratings_count' => 1500,
                'reviews_count' => 450
            ],

            // History
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'genre' => 'history',
                'type' => 'textbook',
                'sales' => 3600,
                'average_rating' => 4.7,
                'ratings_count' => 900,
                'reviews_count' => 250
            ],

            // Biography
            [
                'title' => 'The Diary of a Young Girl',
                'author' => 'Anne Frank',
                'genre' => 'biography',
                'type' => 'novel',
                'sales' => 2900,
                'average_rating' => 4.8,
                'ratings_count' => 800,
                'reviews_count' => 200
            ],

            // Romance - Novel
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'genre' => 'romance',
                'type' => 'novel',
                'sales' => 3400,
                'average_rating' => 4.7,
                'ratings_count' => 880,
                'reviews_count' => 230
            ],

            // Non-fiction
            [
                'title' => 'Thinking, Fast and Slow',
                'author' => 'Daniel Kahneman',
                'genre' => 'non-fiction',
                'type' => 'textbook',
                'sales' => 3100,
                'average_rating' => 4.6,
                'ratings_count' => 820,
                'reviews_count' => 210
            ],

            // Comic
            [
                'title' => 'Watchmen',
                'author' => 'Alan Moore',
                'genre' => 'fiction',
                'type' => 'comic',
                'sales' => 1800,
                'average_rating' => 4.7,
                'ratings_count' => 600,
                'reviews_count' => 150
            ],

            // Magazine
            [
                'title' => 'National Geographic - Wonders of the World',
                'author' => 'Various',
                'genre' => 'non-fiction',
                'type' => 'magazine',
                'sales' => 1200,
                'average_rating' => 4.3,
                'ratings_count' => 400,
                'reviews_count' => 80
            ],

            // Encyclopedia
            [
                'title' => 'Encyclopedia Britannica',
                'author' => 'Various',
                'genre' => 'non-fiction',
                'type' => 'encyclopedia',
                'sales' => 900,
                'average_rating' => 4.2,
                'ratings_count' => 300,
                'reviews_count' => 50
            ],

            // Tambahkan lebih banyak buku di sini...
            [
                'title' => 'The Silent Patient',
                'author' => 'Alex Michaelides',
                'genre' => 'fiction',
                'type' => 'novel',
                'sales' => 2700,
                'average_rating' => 4.5,
                'ratings_count' => 700,
                'reviews_count' => 190
            ],
            [
                'title' => 'Educated',
                'author' => 'Tara Westover',
                'genre' => 'biography',
                'type' => 'novel',
                'sales' => 2300,
                'average_rating' => 4.7,
                'ratings_count' => 650,
                'reviews_count' => 170
            ],
            [
                'title' => 'The Martian',
                'author' => 'Andy Weir',
                'genre' => 'science',
                'type' => 'novel',
                'sales' => 2900,
                'average_rating' => 4.6,
                'ratings_count' => 750,
                'reviews_count' => 200
            ],
            [
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'genre' => 'fantasy',
                'type' => 'novel',
                'sales' => 4800,
                'average_rating' => 4.9,
                'ratings_count' => 1400,
                'reviews_count' => 400
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'genre' => 'non-fiction',
                'type' => 'textbook',
                'sales' => 3500,
                'average_rating' => 4.7,
                'ratings_count' => 950,
                'reviews_count' => 250
            ],
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'genre' => 'fiction',
                'type' => 'novel',
                'sales' => 4000,
                'average_rating' => 4.5,
                'ratings_count' => 1000,
                'reviews_count' => 300
            ],
            [
                'title' => 'Guns, Germs, and Steel',
                'author' => 'Jared Diamond',
                'genre' => 'history',
                'type' => 'textbook',
                'sales' => 2200,
                'average_rating' => 4.4,
                'ratings_count' => 600,
                'reviews_count' => 150
            ],
            [
                'title' => 'The Subtle Art of Not Giving a F*ck',
                'author' => 'Mark Manson',
                'genre' => 'non-fiction',
                'type' => 'textbook',
                'sales' => 3300,
                'average_rating' => 4.3,
                'ratings_count' => 850,
                'reviews_count' => 220
            ],
            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'genre' => 'science',
                'type' => 'novel',
                'sales' => 3100,
                'average_rating' => 4.6,
                'ratings_count' => 800,
                'reviews_count' => 210
            ],
            [
                'title' => 'The Hitchhiker\'s Guide to the Galaxy',
                'author' => 'Douglas Adams',
                'genre' => 'science',
                'type' => 'novel',
                'sales' => 2600,
                'average_rating' => 4.5,
                'ratings_count' => 700,
                'reviews_count' => 180
            ],
            [
                'title' => 'The Girl with the Dragon Tattoo',
                'author' => 'Stieg Larsson',
                'genre' => 'fiction',
                'type' => 'novel',
                'sales' => 2900,
                'average_rating' => 4.4,
                'ratings_count' => 750,
                'reviews_count' => 200
            ],
            [
                'title' => 'The Da Vinci Code',
                'author' => 'Dan Brown',
                'genre' => 'fiction',
                'type' => 'novel',
                'sales' => 3800,
                'average_rating' => 4.2,
                'ratings_count' => 900,
                'reviews_count' => 250
            ],
            [
                'title' => 'The Shining',
                'author' => 'Stephen King',
                'genre' => 'fiction',
                'type' => 'novel',
                'sales' => 3200,
                'average_rating' => 4.6,
                'ratings_count' => 850,
                'reviews_count' => 230
            ],
            [
                'title' => 'The Handmaid\'s Tale',
                'author' => 'Margaret Atwood',
                'genre' => 'fiction',
                'type' => 'novel',
                'sales' => 2700,
                'average_rating' => 4.5,
                'ratings_count' => 700,
                'reviews_count' => 190
            ],
            [
                'title' => 'Born a Crime',
                'author' => 'Trevor Noah',
                'genre' => 'biography',
                'type' => 'novel',
                'sales' => 2400,
                'average_rating' => 4.7,
                'ratings_count' => 650,
                'reviews_count' => 170
            ],
            [
                'title' => 'The Power of Now',
                'author' => 'Eckhart Tolle',
                'genre' => 'non-fiction',
                'type' => 'textbook',
                'sales' => 2800,
                'average_rating' => 4.4,
                'ratings_count' => 750,
                'reviews_count' => 200
            ],
            [
                'title' => 'The Art of War',
                'author' => 'Sun Tzu',
                'genre' => 'non-fiction',
                'type' => 'textbook',
                'sales' => 1900,
                'average_rating' => 4.5,
                'ratings_count' => 500,
                'reviews_count' => 120
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}