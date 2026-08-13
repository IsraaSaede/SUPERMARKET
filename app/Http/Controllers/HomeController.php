<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->get();

        $products = Product::where('is_active', true)
            ->latest()
            ->take(12)
            ->get();

        return view('home', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
