@extends('layouts.app')

@section('title', 'الرئيسية - ' . ($settings->store_name ?? 'سوبر ماركت'))

@section('content')

    {{-- السلايدر --}}
    @if ($sliders->isNotEmpty())
        <section class="mb-12" x-data="{
                active: 0,
                total: {{ $sliders->count() }},
                start() {
                    setInterval(() => {
                        this.active = (this.active + 1) % this.total;
                    }, 4000);
                }
            }" x-init="start()">

            <div class="relative rounded-xl overflow-hidden shadow-sm">

                @foreach ($sliders as $index => $slider)
                    <div x-show="active === {{ $index }}"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         class="relative w-full aspect-[16/6] bg-slate-100">

                        <img src="{{ asset('storage/' . $slider->image) }}"
                             alt="{{ $slider->title }}"
                             class="w-full h-full object-cover">

                        @if ($slider->title || $slider->description)
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex flex-col justify-end p-6">
                                @if ($slider->title)
                                    <h3 class="text-white text-xl md:text-2xl font-bold">{{ $slider->title }}</h3>
                                @endif

                                @if ($slider->description)
                                    <p class="text-white/90 text-sm mt-1">{{ $slider->description }}</p>
                                @endif
                            </div>
                        @endif

                    </div>
                @endforeach

                {{-- نقاط التنقل --}}
                @if ($sliders->count() > 1)
                    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2">
                        @foreach ($sliders as $index => $slider)
                            <button
                                type="button"
                                x-on:click="active = {{ $index }}"
                                class="w-2.5 h-2.5 rounded-full transition"
                                :class="active === {{ $index }} ? 'bg-white' : 'bg-white/50'"
                            ></button>
                        @endforeach
                    </div>
                @endif

            </div>
        </section>
    @endif

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
