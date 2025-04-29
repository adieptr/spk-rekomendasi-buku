<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function recommend(Request $request)
    {
        // Ambil semua buku dari database
        $books = Book::all();

        // Hitung preferensi untuk setiap buku
        $preferences = $this->getPreferences($request, $books);

        // Gabungkan buku dengan preferensi
        $recommendations = $books->map(function ($book, $index) use ($preferences) {
            return [
                'book' => $book,
                'preference' => $preferences[$index] ?? 0, // default 0 jika tidak ada
            ];
        })
        ->sortByDesc('preference') // Urutkan dari preferensi tertinggi
        ->values()
        ->all();

        // Filter berdasarkan genre, type, dan minimum rating
        if ($request->filled('genre')) {
            $recommendations = array_filter($recommendations, function ($rec) use ($request) {
                return $rec['book']->genre === $request->genre;
            });
        }

        if ($request->filled('type')) {
            $recommendations = array_filter($recommendations, function ($rec) use ($request) {
                return $rec['book']->type === $request->type;
            });
        }

        if ($request->filled('min_rating')) {
            $recommendations = array_filter($recommendations, function ($rec) use ($request) {
                return $rec['book']->average_rating >= (float) $request->min_rating;
            });
        }

        return view('recommendations', [
            'recommendations' => $recommendations,
        ]);
    }

    // Hitung preferensi untuk setiap buku
    private function getPreferences(Request $request, $books)
    {
        $preferences = [];

        foreach ($books as $book) {
            $score = 0;

            // Tambah skor kalau genre cocok
            if ($request->filled('genre') && $book->genre == $request->genre) {
                $score += 0.5;
            }

            // Tambah skor kalau type cocok
            if ($request->filled('type') && $book->type == $request->type) {
                $score += 0.3;
            }

            // Tambah skor dari rating
            $score += ($book->average_rating / 5) * 0.2;

            $preferences[] = $score; // Skor akhir
        }

        return $preferences;
    }
}
