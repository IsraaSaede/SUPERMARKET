@extends('layouts.app')

@section('title', 'الرئيسية - ' . ($settings->store_name ?? 'سوبر ماركت'))

@section('content')

    {{-- الأصناف --}}
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-5 text-slate-900">تسوق حسب الصنف</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">

            @forelse ($categories as $category)

                <a href="{{ route('category.show', $category) }}"
                   class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 text-center hover:shadow-md hover:-translate-y-0.5 transition cursor-pointer block">

                    {{-- صورة التصنيف --}}
                    @if ($category->image)

                        <img src="{{ asset('storage/' . $category->image) }}"
                             alt="{{ $category->name }}"
                             class="w-16 h-16 object-cover mx-auto mb-3 rounded-full ring-2 ring-slate-100">

                    @else

                        <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-100 flex items-center justify-center text-slate-900 font-bold text-lg">
                            {{ mb_substr($category->name, 0, 1) }}
                        </div>

                    @endif

                    {{-- اسم التصنيف --}}
                    <p class="font-medium text-sm">
                        {{ $category->name }}
                    </p>

                </a>

            @empty

                <p class="text-gray-400 col-span-full">
                    لا توجد أصناف حالياً.
                </p>

            @endforelse

        </div>
    </section>


    {{-- أحدث المنتجات --}}
    <section>

        <h2 class="text-2xl font-bold mb-5 text-slate-900">
            أحدث المنتجات
        </h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">

            @forelse ($products as $product)

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition">

                    {{-- صورة المنتج --}}
                    <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">

                        @if ($product->image)

                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover">

                        @else

                            <span class="text-gray-300 text-4xl">
                                🛒
                            </span>

                        @endif

                    </div>


                    {{-- معلومات المنتج --}}
                    <div class="p-3">

                        <p class="font-medium text-sm truncate">
                            {{ $product->name }}
                        </p>

                        <p class="text-orange-600 font-bold mt-1">
                            {{ number_format($product->price, 2) }} ل.س
                        </p>


                        {{-- إضافة للسلة --}}
                        <livewire:add-to-cart-button
                            :product-id="$product->id"
                            wire:key="cart-btn-{{ $product->id }}"
                        />

                    </div>

                </div>

            @empty

                <p class="text-gray-400 col-span-full">
                    لا توجد منتجات حالياً.
                </p>

            @endforelse

        </div>

    </section>

@endsection
