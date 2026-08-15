<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings->store_name ?? 'سوبر ماركت')</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">

    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-slate-900 shrink-0">
                    <img src="{{ asset('images/logo.png') }}"
                        alt="{{ $settings->store_name ?? 'سوبر ماركت' }}"
                        class="h-10 w-10 shrink-0 object-contain">

                    <span class="hidden sm:inline">{{ $settings->store_name ?? 'سوبر ماركت' }}</span>
                </a>

                <div class="flex-1 max-w-md">
                    <livewire:search-products />
                </div>

                <nav class="flex items-center gap-6 text-sm font-medium shrink-0">
                    <a href="{{ route('home') }}" class="hover:text-orange-600 transition hidden sm:inline">الرئيسية</a>
                    <a href="{{ route('contact') }}" class="hover:text-orange-600 transition hidden sm:inline">تواصل معنا</a>
                    <livewire:cart-icon />
                </nav>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8 flex-1 w-full">
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-gray-300 mt-12 py-6 text-center text-sm">
        &copy; {{ date('Y') }} {{ $settings->store_name ?? 'سوبر ماركت' }}. جميع الحقوق محفوظة.
    </footer>

</body>
</html>
