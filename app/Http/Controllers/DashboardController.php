<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Ringkasan
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalAuthors = Book::distinct('author')->count('author');

        // 2. Data untuk Grafik (Jumlah buku per kategori)
        $categories = Category::withCount('books')->get();
        $chartLabels = $categories->pluck('name');
        $chartData = $categories->pluck('books_count');

        // 3. Buku Terbaru (Ambil 5 terakhir)
        $recentBooks = Book::with('category')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalBooks', 
            'totalCategories', 
            'totalAuthors', 
            'chartLabels', 
            'chartData',
            'recentBooks'
        ));
    }
}