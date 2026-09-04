@extends('layouts.app')

@section('title', 'الرئيسية - ' . ($settings->store_name ?? 'سوبر ماركت'))

@section('content')

    {{-- ==================== زر "اطلب الآن" العائم ====================
         يظهر تلقائيًا فقط إذا كانت السلة غير فارغة، ويعرض عدد القطع،
         المبلغ، رسم التوصيل، والإجمالي، وينقل مباشرة لصفحة السلة. --}}
    <livewire:cart-summary-button />


    {{-- ==================== شريط خيارات الدفع ==================== --}}
    <div class="mb-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-slate-600 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
        <span class="flex items-center gap-1.5 font-medium">
            💵 الدفع عند الاستلام كاش او شام كاش
        </span>
        <span class="hidden sm:inline text-slate-300">|</span>
        <span class="flex items-center gap-1.5">
            🚚 توصيل لجميع أحياء حمص
        </span>
    </div>


    {{-- ==================== السلايدر ==================== --}}
    @if ($sliders->isNotEmpty())
        <section
            class="mb-14"
            x-data="{
                active: 0,
                total: {{ $sliders->count() }},
                timer: null,

                start() {
                    if (this.total > 1) {
                        this.timer = setInterval(() => {
                            this.active = (this.active + 1) % this.total;
                        }, 5000);
                    }
                },

                stop() {
                    clearInterval(this.timer);
                }
            }"
            x-init="start()"
            @mouseenter="stop()"
            @mouseleave="start()"
        >
            <div class="relative overflow-hidden rounded-2xl shadow-md bg-slate-100">

                @foreach ($sliders as $index => $slider)

                    @php
                        $sliderImage = $slider->image;

                        $sliderImageUrl = $sliderImage
                            ? (str_starts_with($sliderImage, 'http://') || str_starts_with($sliderImage, 'https://')
                                ? $sliderImage
                                : asset('storage/' . $sliderImage))
                            : null;
                    @endphp

                    <div
                        x-show="active === {{ $index }}"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        class="relative w-full aspect-[16/6] min-h-[220px] md:min-h-[300px] lg:min-h-[380px]"
                    >

                        @if ($sliderImageUrl)
                            <img
                                src="{{ $sliderImageUrl }}"
                                alt="{{ $slider->title ?? 'عرض' }}"
                                class="absolute inset-0 w-full h-full object-cover"
                            >
                        @endif

                        @if ($slider->title || $slider->description)
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent flex flex-col justify-end p-5 md:p-8 lg:p-10">

                                @if ($slider->title)
                                    <h2 class="text-white text-xl md:text-3xl lg:text-4xl font-bold drop-shadow-md">
                                        {{ $slider->title }}
                                    </h2>
                                @endif

                                @if ($slider->description)
                                    <p class="text-white/90 text-sm md:text-base lg:text-lg mt-2 max-w-2xl">
                                        {{ $slider->description }}
                                    </p>
                                @endif

                            </div>
                        @endif

                    </div>

                @endforeach

                {{-- نقاط التنقل --}}
                @if ($sliders->count() > 1)
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                        @foreach ($sliders as $index => $slider)
                            <button
                                type="button"
                                x-on:click="active = {{ $index }}"
                                class="w-3 h-3 rounded-full transition-all"
                                :class="active === {{ $index }}
                                    ? 'bg-white scale-110'
                                    : 'bg-white/50 hover:bg-white/80'"
                                aria-label="انتقل إلى الشريحة {{ $index + 1 }}"
                            ></button>
                        @endforeach
                    </div>
                @endif

            </div>
        </section>
    @endif


    {{--
        ==================== 🔥 العروض الحالية ====================
        بدون أي حقل أو جدول جديد بقاعدة البيانات: هذا القسم يعرض أي منتج
        منتمٍ لتصنيف اسمه يحتوي كلمة "عرض" (أنشئ تصنيفًا من لوحة التحكم
        اسمه مثلاً "عروض" أو "عروض اليوم"، وأي منتج تضعه فيه يظهر هنا
        تلقائيًا). ملاحظة: بما أنه لا يوجد حقل "السعر قبل الخصم" بجدول
        المنتجات، لا يمكن عرض سعر مشطوب حقيقي هنا - فقط شارة "عرض خاص".
    --}}
    @if ($offers->isNotEmpty())
        <section class="mb-14">

            <div class="flex items-center gap-2 mb-6 bg-gradient-to-l from-orange-50 to-white border border-orange-100 rounded-2xl p-4 md:p-5">
                <span class="text-2xl">🔥</span>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900">
                        العروض الحالية
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        منتجات مختارة ضمن عروضنا الحالية
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-5 gap-4 md:gap-5 lg:gap-6">

                @foreach ($offers as $product)

                    @php
                        $productImageUrl = $product->image_url;
                    @endphp

                    <div class="group relative bg-white rounded-2xl border border-orange-200 shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300">

                        <span class="absolute top-2 right-2 z-10 bg-orange-600 text-white text-xs font-bold rounded-full px-2 py-1 shadow">
                            عرض خاص
                        </span>

                        <div class="aspect-square bg-slate-50 flex items-center justify-center overflow-hidden">

                            @if ($productImageUrl)
                                <img
                                    src="{{ $productImageUrl }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                >
                            @else
                                <span class="text-slate-300 text-5xl">🛒</span>
                            @endif

                        </div>

                        <div class="p-4">

                            <p
                                class="font-semibold text-sm md:text-base text-slate-800 truncate"
                                title="{{ $product->name }}"
                            >
                                {{ $product->name }}
                            </p>

                            <p class="text-orange-600 font-bold text-base md:text-lg mt-1 mb-3">
                                {{ number_format($product->price, 2) }} ل.س
                            </p>

                            <livewire:add-to-cart-button
                                :product-id="$product->id"
                                wire:key="offer-cart-btn-{{ $product->id }}"
                            />

                        </div>

                    </div>

                @endforeach

            </div>

        </section>
    @endif


    {{--
        ==================== ⭐ الأكثر مبيعًا ====================
        محسوبة تلقائيًا من عدد القطع المباعة فعليًا (order_items)،
        بدون أي حقل أو جدول جديد. يظهر القسم فقط بعد تسجيل مبيعات حقيقية.
    --}}
    @if ($bestSellers->isNotEmpty())
        <section class="mb-14">

            <div class="mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">
                    ⭐ الأكثر مبيعًا
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    المنتجات الأكثر طلبًا من عملائنا
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-5 gap-4 md:gap-5 lg:gap-6">

                @foreach ($bestSellers as $product)

                    @php
                        $productImageUrl = $product->image_url;
                    @endphp

                    <div class="group bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300">

                        <div class="aspect-square bg-slate-50 flex items-center justify-center overflow-hidden">

                            @if ($productImageUrl)
                                <img
                                    src="{{ $productImageUrl }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                >
                            @else
                                <span class="text-slate-300 text-5xl">🛒</span>
                            @endif

                        </div>

                        <div class="p-4">

                            <p
                                class="font-semibold text-sm md:text-base text-slate-800 truncate"
                                title="{{ $product->name }}"
                            >
                                {{ $product->name }}
                            </p>

                            <p class="text-orange-600 font-bold text-base md:text-lg mt-1 mb-3">
                                {{ number_format($product->price, 2) }} ل.س
                            </p>

                            <livewire:add-to-cart-button
                                :product-id="$product->id"
                                wire:key="bestseller-cart-btn-{{ $product->id }}"
                            />

                        </div>

                    </div>

                @endforeach

            </div>

        </section>
    @endif


    {{-- ==================== التصنيفات ==================== --}}
    <section class="mb-14">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">
                    تسوق حسب الصنف
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    اختر الصنف الذي تبحث عنه
                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6 gap-4 lg:gap-5">

            @forelse ($categories as $category)

                @php
                    $categoryImage = $category->image;

                    $categoryImageUrl = $categoryImage
                        ? (str_starts_with($categoryImage, 'http://') || str_starts_with($categoryImage, 'https://')
                            ? $categoryImage
                            : asset('storage/' . $categoryImage))
                        : null;
                @endphp

                <a
                    href="{{ route('category.show', $category) }}"
                    class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-4 md:p-5 text-center"
                >

                    <div class="w-20 h-20 md:w-24 md:h-24 mx-auto mb-4 rounded-full overflow-hidden bg-slate-50 flex items-center justify-center">

                        @if ($categoryImageUrl)

                            <img
                                src="{{ $categoryImageUrl }}"
                                alt="{{ $category->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            >

                        @else

                            <span class="text-slate-500 font-bold text-2xl">
                                {{ mb_substr($category->name, 0, 1) }}
                            </span>

                        @endif

                    </div>

                    <p class="font-semibold text-sm md:text-base text-slate-800 group-hover:text-orange-600 transition">
                        {{ $category->name }}
                    </p>

                </a>

            @empty

                <p class="text-slate-400 col-span-full text-center py-10">
                    لا توجد أصناف حالياً.
                </p>

            @endforelse

        </div>

    </section>


    {{-- ==================== وصل حديثًا ==================== --}}
    <section>

        <div class="flex items-end justify-between mb-6">

            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">
                    🆕 وصل حديثًا
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    أحدث المنتجات المضافة إلى المتجر
                </p>
            </div>

        </div>


        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-5 gap-4 md:gap-5 lg:gap-6">

            @forelse ($products as $product)

                <div class="group bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300">

                    {{-- صورة المنتج --}}
                    @php
                        $productImageUrl = $product->image_url;
                    @endphp

                    <div class="aspect-square bg-slate-50 flex items-center justify-center overflow-hidden">

                        @if ($productImageUrl)

                            <img
                                src="{{ $productImageUrl }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                            >

                        @else

                            <span class="text-slate-300 text-5xl">
                                🛒
                            </span>

                        @endif

                    </div>


                    {{-- معلومات المنتج --}}
                    <div class="p-4">

                        <p
                            class="font-semibold text-sm md:text-base text-slate-800 truncate"
                            title="{{ $product->name }}"
                        >
                            {{ $product->name }}
                        </p>

                        <p class="text-orange-600 font-bold text-base md:text-lg mt-1 mb-3">
                            {{ number_format($product->price, 2) }} ل.س
                        </p>

                        <livewire:add-to-cart-button
                            :product-id="$product->id"
                            wire:key="cart-btn-{{ $product->id }}"
                        />

                    </div>

                </div>

            @empty

                <p class="text-slate-400 col-span-full text-center py-10">
                    لا توجد منتجات حالياً.
                </p>

            @endforelse

        </div>

        <div class="mt-10 flex justify-center">
            {{ $products->links('vendor.pagination.tailwind') }}
        </div>

    </section>

@endsection
