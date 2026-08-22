@extends('layouts.app')

@section('title', $category->name . ' - ' . ($settings->store_name ?? 'سوبر ماركت'))

@section('content')

    {{-- عنوان التصنيف --}}
    <section class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">
                    {{ $category->name }}
                </h1>

                <p class="text-gray-500 text-sm mt-1">
                    منتجات {{ $category->name }}
                </p>
            </div>

            <a href="{{ route('home') }}"
               class="text-green-700 hover:text-green-800 font-medium text-sm">
                ← العودة للرئيسية
            </a>
        </div>
    </section>

    {{-- المنتجات --}}
    <section>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">

            @forelse ($products as $product)

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition">

                    {{-- صورة المنتج --}}
                    <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">

                        @if ($product->image_url)

                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover">

                        @else

                            <span class="text-gray-300 text-4xl">🛒</span>

                        @endif

                    </div>

                    {{-- معلومات المنتج --}}
                    <div class="p-3">

                        <p class="font-medium text-sm truncate">
                            {{ $product->name }}
                        </p>

                        <p class="text-green-700 font-bold mt-1">
                            {{ number_format($product->price, 2) }} ل.س
                        </p>

                        <livewire:add-to-cart-button
                            :product-id="$product->id"
                            wire:key="category-cart-btn-{{ $product->id }}"
                        />

                    </div>

                </div>

            @empty

                <div class="col-span-full text-center py-12">

                    <div class="text-5xl mb-4">
                        🛒
                    </div>

                    <p class="text-gray-500">
                        لا توجد منتجات في هذا التصنيف حالياً.
                    </p>

                    <a href="{{ route('home') }}"
                       class="inline-block mt-4 text-green-700 font-medium">
                        العودة للرئيسية
                    </a>

                </div>

            @endforelse

        </div>
    </section>

@endsection
