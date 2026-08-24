<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', $settings->store_name ?? 'سوبر ماركت')
    </title>

    @vite('resources/css/app.css')

    @livewireStyles

    {{-- ==================== Google Analytics ==================== --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8KPPTLQ2HB"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-8KPPTLQ2HB');
    </script>

</head>


<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col">

    {{-- ==================== Header ==================== --}}

    <header
        class="bg-white border-b border-slate-200 sticky top-0 z-50"
        x-data="{ mobileMenuOpen: false }"
    >

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="min-h-[76px] flex items-center gap-4">

                {{-- زر القائمة للموبايل --}}

                <button
                    type="button"
                    x-on:click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden text-2xl text-slate-700 shrink-0"
                    aria-label="فتح القائمة"
                >
                    ☰
                </button>


                {{-- الشعار --}}

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 shrink-0"
                >

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="{{ $settings->store_name ?? 'سوبر ماركت' }}"
                        class="h-11 w-11 md:h-12 md:w-12 object-contain"
                    >

                    <span class="hidden sm:block text-lg md:text-xl font-bold text-slate-900 whitespace-nowrap">
                        {{ $settings->store_name ?? 'سوبر ماركت' }}
                    </span>

                </a>


                {{-- البحث --}}

                <div class="flex-1 max-w-2xl mx-auto">

                    <livewire:search-products />

                </div>


                {{-- القائمة --}}

                <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold shrink-0">

                    <a
                        href="{{ route('home') }}"
                        class="text-slate-700 hover:text-orange-600 transition"
                    >
                        الرئيسية
                    </a>

                    <a
                        href="{{ route('contact') }}"
                        class="text-slate-700 hover:text-orange-600 transition"
                    >
                        تواصل معنا
                    </a>

                </nav>


                {{-- السلة --}}

                <div class="shrink-0">

                    <livewire:cart-icon />

                </div>

            </div>


            {{-- قائمة الموبايل --}}

            <div
                x-show="mobileMenuOpen"
                x-on:click.outside="mobileMenuOpen = false"
                x-transition
                class="lg:hidden border-t border-slate-100 py-4"
                style="display: none;"
            >

                <div class="flex flex-col gap-3 text-sm font-semibold">

                    <a
                        href="{{ route('home') }}"
                        class="py-2 text-slate-700 hover:text-orange-600"
                    >
                        الرئيسية
                    </a>

                    <a
                        href="{{ route('contact') }}"
                        class="py-2 text-slate-700 hover:text-orange-600"
                    >
                        تواصل معنا
                    </a>

                </div>

            </div>

        </div>

    </header>


    {{-- ==================== Main ==================== --}}

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10 flex-1 w-full">

        @yield('content')

    </main>


    {{-- ==================== Footer ==================== --}}

    <footer class="bg-slate-900 text-slate-300 mt-16">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div class="text-center">

                <div class="flex justify-center items-center gap-3 mb-3">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="{{ $settings->store_name ?? 'سوبر ماركت' }}"
                        class="w-10 h-10 object-contain"
                    >

                    <span class="font-bold text-white">
                        {{ $settings->store_name ?? 'سوبر ماركت' }}
                    </span>

                </div>
                <p class="text-sm text-slate-400">
                    &copy; {{ date('Y') }} سوبر ماركت الباشا
                    <br>
                    تطوير وبرمجة:
                    <a href="mailto:israasaede@gmail.com" class="hover:text-white transition">
                        israa saede
                    </a>
                </p>

            </div>

        </div>

    </footer>


    @livewireScripts
    <script>
        document.addEventListener('livewire:init', () => {
            // ==============================
            // إضافة منتج إلى السلة
            // ==============================
            Livewire.on('analytics-add-to-cart', (data) => {
                gtag('event', 'add_to_cart', {
                    currency: 'SYP',
                    value: Number(data.value),
                    items: [{
                        item_id: String(data.product_id),
                        item_name: data.product_name,
                        item_category: data.category || undefined,
                        price: Number(data.price),
                        quantity: Number(data.quantity)
                    }]
                });
            });
            // ==============================
            // إرسال الطلب عبر واتساب
            // ==============================
            Livewire.on('analytics-whatsapp-order', (data) => {
                gtag('event', 'whatsapp_order', {
                    currency: 'SYP',
                    value: Number(data.value)
                });
            });
        });
    </script>
</body>

</html>
