<?php

namespace App\Services;

use Exception;

class TopsisService
{
    public function calculateTopsis(array $books, array $weights, array $criteria): array
    {
        if (empty($books) || empty($weights) || empty($criteria)) {
            throw new Exception('Books, weights, or criteria cannot be empty.');
        }

        //1: Normalisasi matriks keputusan
        $normalizedMatrix = $this->normalizeMatrix($books, $criteria);

        //2: Pembobotan matriks ternormalisasi
        $weightedMatrix = $this->weightMatrix($normalizedMatrix, $weights, $criteria);

        //3: Menentukan solusi ideal positif dan negatif
        $idealSolutions = $this->determineIdealSolutions($weightedMatrix, $criteria);

        //4: Menghitung jarak terhadap solusi ideal
        $distances = $this->calculateDistances($weightedMatrix, $idealSolutions, $criteria);

        //5: Menghitung nilai preferensi
        $preferences = $this->calculatePreferences($distances, count($books));

        // Menggabungkan hasil dengan data buku
        $result = collect($books)->map(function ($book, $index) use ($preferences) {
            return [
                'book' => $book,
                'preference' => $preferences[$index]
            ];
        })->sortByDesc('preference')->values()->toArray();

        return $result;
    }

    private function normalizeMatrix(array $books, array $criteria): array
    {
        $sumSquares = [];

        // Inisialisasi sum squares
        foreach ($criteria as $criterion) {
            $sumSquares[$criterion] = 0;
        }

        // Hitung sum squares
        foreach ($books as $book) {
            foreach ($criteria as $criterion) {
                $sumSquares[$criterion] += pow($book[$criterion] ?? 0, 2);
            }
        }

        // Normalisasi
        $matrix = [];
        foreach ($books as $book) {
            $normalized = [];
            foreach ($criteria as $criterion) {
                $denominator = sqrt($sumSquares[$criterion]);
                $normalized[$criterion] = $denominator == 0 ? 0 : ($book[$criterion] ?? 0) / $denominator;
            }
            $matrix[] = $normalized;
        }

        return $matrix;
    }

    private function weightMatrix(array $normalizedMatrix, array $weights, array $criteria): array
    {
        $weightedMatrix = [];

        foreach ($normalizedMatrix as $row) {
            $weightedRow = [];
            foreach ($criteria as $criterion) {
                $weightedRow[$criterion] = ($row[$criterion] ?? 0) * ($weights[$criterion] ?? 0);
            }
            $weightedMatrix[] = $weightedRow;
        }

        return $weightedMatrix;
    }

    private function determineIdealSolutions(array $weightedMatrix, array $criteria): array
    {
        $positiveIdeal = [];
        $negativeIdeal = [];

        foreach ($criteria as $criterion) {
            $values = array_column($weightedMatrix, $criterion);
            $positiveIdeal[$criterion] = max($values);
            $negativeIdeal[$criterion] = min($values);
        }

        return [
            'positive' => $positiveIdeal,
            'negative' => $negativeIdeal
        ];
    }

    private function calculateDistances(array $weightedMatrix, array $idealSolutions, array $criteria): array
    {
        $distances = [];

        foreach ($weightedMatrix as $row) {
            $positiveDistance = 0;
            $negativeDistance = 0;

            foreach ($criteria as $criterion) {
                $positiveDistance += pow(($row[$criterion] ?? 0) - ($idealSolutions['positive'][$criterion] ?? 0), 2);
                $negativeDistance += pow(($row[$criterion] ?? 0) - ($idealSolutions['negative'][$criterion] ?? 0), 2);
            }

            $distances[] = [
                'positive' => sqrt($positiveDistance),
                'negative' => sqrt($negativeDistance)
            ];
        }

        // [Opsional] Debug distances
        /*
        logger('Distances:', $distances);
        */

        return $distances;
    }

    private function calculatePreferences(array $distances, int $count): array
    {
        $preferences = [];

        for ($i = 0; $i < $count; $i++) {
            $positive = $distances[$i]['positive'] ?? 0;
            $negative = $distances[$i]['negative'] ?? 0;
            $denominator = $positive + $negative;

            $preferences[$i] = ($denominator == 0) ? 0 : ($negative / $denominator);
        }

        return $preferences;
    }
}
