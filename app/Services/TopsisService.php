<?php

namespace App\Services;

class TopsisService
{
    public function calculateTopsis($books, $weights, $criteria)
    {
        // Step 1: Normalisasi matriks keputusan
        $normalizedMatrix = $this->normalizeMatrix($books, $criteria);

        // Step 2: Pembobotan matriks ternormalisasi
        $weightedMatrix = $this->weightMatrix($normalizedMatrix, $weights, $criteria);

        // Step 3: Menentukan solusi ideal positif dan negatif
        $idealSolutions = $this->determineIdealSolutions($weightedMatrix, $criteria);

        // Step 4: Menghitung jarak terhadap solusi ideal
        $distances = $this->calculateDistances($weightedMatrix, $idealSolutions, $criteria);

        // Step 5: Menghitung nilai preferensi
        $preferences = $this->calculatePreferences($distances, count($books));

        // Menggabungkan hasil dengan data buku
        $result = [];
        foreach ($books as $index => $book) {
            $result[] = [
                'book' => $book,
                'preference' => $preferences[$index]
            ];
        }

        // Mengurutkan berdasarkan nilai preferensi tertinggi
        usort($result, function ($a, $b) {
            return $b['preference'] <=> $a['preference'];
        });

        return $result;
    }

    private function normalizeMatrix($books, $criteria)
    {
        $matrix = [];
        $sumSquares = [];

        // Inisialisasi sum squares
        foreach ($criteria as $criterion) {
            $sumSquares[$criterion] = 0;
        }

        // Hitung sum squares
        foreach ($books as $book) {
            foreach ($criteria as $criterion) {
                $sumSquares[$criterion] += pow($book[$criterion], 2);
            }
        }

        // Normalisasi
        foreach ($books as $book) {
            $normalized = [];
            foreach ($criteria as $criterion) {
                $normalized[$criterion] = $book[$criterion] / sqrt($sumSquares[$criterion]);
            }
            $matrix[] = $normalized;
        }

        return $matrix;
    }

    private function weightMatrix($normalizedMatrix, $weights, $criteria)
    {
        $weightedMatrix = [];

        foreach ($normalizedMatrix as $row) {
            $weightedRow = [];
            foreach ($criteria as $criterion) {
                $weightedRow[$criterion] = $row[$criterion] * $weights[$criterion];
            }
            $weightedMatrix[] = $weightedRow;
        }

        return $weightedMatrix;
    }

    private function determineIdealSolutions($weightedMatrix, $criteria)
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

    private function calculateDistances($weightedMatrix, $idealSolutions, $criteria)
    {
        $distances = [];

        foreach ($weightedMatrix as $row) {
            $positiveDistance = 0;
            $negativeDistance = 0;

            foreach ($criteria as $criterion) {
                $positiveDistance += pow($row[$criterion] - $idealSolutions['positive'][$criterion], 2);
                $negativeDistance += pow($row[$criterion] - $idealSolutions['negative'][$criterion], 2);
            }

            $distances[] = [
                'positive' => sqrt($positiveDistance),
                'negative' => sqrt($negativeDistance)
            ];
        }

        return $distances;
    }

    private function calculatePreferences($distances, $count)
    {
        $preferences = [];

        for ($i = 0; $i < $count; $i++) {
            $preferences[$i] = $distances[$i]['negative'] / ($distances[$i]['positive'] + $distances[$i]['negative']);
        }

        return $preferences;
    }
}