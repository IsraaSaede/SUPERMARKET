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

        // ==================== العروض الحالية ====================
        // بدون أي حقل أو جدول جديد: أي منتج ضمن تصنيف اسمه يحتوي كلمة "عرض"
        // (مثال: أنشئ تصنيف من لوحة التحكم اسمه "عروض" أو "عروض اليوم"،
        // وأي منتج تحطه ضمن هذا التصنيف بيظهر تلقائيًا هون).
        $offerCategoryIds = $categories
            ->filter(fn ($category) => str_contains($category->name, 'عرض'))
            ->pluck('id');

        $offers = Product::where('is_active', true)
            ->whereIn('category_id', $offerCategoryIds)
            ->latest()
            ->take(10)
            ->get();

        // ==================== الأكثر مبيعًا ====================
        // محسوبة من عدد القطع المباعة فعليًا عبر order_items (بيانات حقيقية
        // موجودة أصلاً)، بدون أي حقل جديد بجدول المنتجات.
        // ملاحظة: بفترض أن عمود الكمية بجدول order_items اسمه "quantity"
        // - عدّل الاسم أدناه إذا كان مختلفًا عندك.
        $bestSellers = Product::where('is_active', true)
            ->withSum('orderItems as total_sold', 'quantity')
            ->orderByDesc('total_sold')
            ->take(10)
            ->get()
            ->filter(fn ($product) => $product->total_sold > 0)
            ->values();

        // ==================== وصل حديثًا ====================
        $products = Product::where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('home', [
            'sliders' => $sliders,
            'categories' => $categories,
            'offers' => $offers,
            'bestSellers' => $bestSellers,
            'products' => $products,
        ]);
    }
}
