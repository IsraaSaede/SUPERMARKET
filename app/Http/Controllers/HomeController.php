<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)
            ->orderBy('order')
            ->get();

        $categories = Category::where('is_active', true)->get();

        $products = Product::where('is_active', true)
            ->latest()
            ->take(12)
            ->get();

        return view('home', [
            'sliders' => $sliders,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
