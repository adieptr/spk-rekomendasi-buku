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
        'genre' => 'sometimes|nullable|in:fiction,non-fiction,science,history,biography,fantasy,romance',
        'type' => 'sometimes|nullable|in:novel,textbook,comic,magazine,encyclopedia',
        'min_rating' => 'sometimes|nullable|numeric|min:0|max:5'
    ]);

    $query = Book::query();

    if (!empty($request->genre)) {
        $query->where('genre', $request->genre);
    }

    if (!empty($request->type)) {
        $query->where('type', $request->type);
    }

    if (!empty($request->min_rating)) {
        $query->where('average_rating', '>=', $request->min_rating);
    }

    $books = $query->get();

    // Bobot kriteria
    $weights = [
        'sales' => 0.3,
        'average_rating' => 0.4,
        'reviews_count' => 0.2,
        'ratings_count' => 0.1
    ];

    $criteria = array_keys($weights);

    // Jika tidak ada buku, langsung kosongkan rekomendasi
    $recommendations = $books->isNotEmpty()
        ? $this->topsisService->calculateTopsis($books->toArray(), $weights, $criteria)
        : [];

    // Pastikan filter lagi, jaga-jaga hasil topsis null
    $recommendations = collect($recommendations)->filter()->values()->toArray();

    return view('recommendations', compact('recommendations'));
}

    // Method lainnya untuk CRUD buku
}