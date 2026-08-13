<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;


// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])
    ->name('home');


// التصنيفات
Route::get('/category/{category}', [CategoryController::class, 'show'])
    ->name('category.show');


// السلة
Route::get('/cart', function () {
    return view('cart');
})->name('cart');
// تواصل
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
