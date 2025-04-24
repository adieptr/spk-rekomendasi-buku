<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\TopsisService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $topsisService;

    public function __construct(TopsisService $topsisService)
    {
        $this->topsisService = $topsisService;
    }

    public function recommend(Request $request)
    {
        $request->validate([
            'genre' => 'sometimes|in:fiction,non-fiction,science,history,biography,fantasy,romance',
            'type' => 'sometimes|in:novel,textbook,comic,magazine,encyclopedia',
            'min_rating' => 'sometimes|numeric|min:0|max:5'
        ]);

        $query = Book::query();

        if ($request->has('genre')) {
            $query->where('genre', $request->genre);
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('min_rating')) {
            $query->where('average_rating', '>=', $request->min_rating);
        }

        $books = $query->get()->toArray();

        // Bobot kriteria (dapat disesuaikan)
        $weights = [
            'sales' => 0.3,
            'average_rating' => 0.4,
            'reviews_count' => 0.2,
            'ratings_count' => 0.1
        ];

        // Kriteria yang digunakan
        $criteria = array_keys($weights);

        $recommendations = $this->topsisService->calculateTopsis($books, $weights, $criteria);

        return view('recommendations', compact('recommendations'));
    }

    // Method lainnya untuk CRUD buku
}