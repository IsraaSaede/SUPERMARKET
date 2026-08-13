@extends('layouts.app')

@section('title', 'تواصل معنا - ' . ($settings->store_name ?? 'سوبر ماركت'))

@section('content')

    <h2 class="text-2xl font-bold mb-6 text-slate-900 text-center">تواصل معنا</h2>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 max-w-full">

        @if ($settings?->logo)
    <img src="{{ asset('storage/' . $settings->logo) }}"
         alt="{{ $settings->store_name }}"
         class="h-32 w-32 rounded-full object-cover mx-auto mb-4">
@endif

        <h3 class="text-xl font-bold text-center text-slate-900 mb-6">
            {{ $settings->store_name ?? 'سوبر ماركت' }}
        </h3>

        <div class="space-y-4" >

            @if ($settings?->address)
                <div class="flex items-start gap-3">
                    <span class="text-xl">📍</span>
                    <div>
                        <p class="text-sm text-gray-500">العنوان</p>
                        <p class="font-medium">{{ $settings->address }}</p>
                    </div>
                </div>
            @endif

            @if ($settings?->phone)
                <div class="flex items-start gap-3">
                    <span class="text-xl">📞</span>
                    <div>
                        <p class="text-sm text-gray-500">رقم الهاتف</p>
                        <a href="tel:{{ $settings->phone }}" class="font-medium hover:text-orange-600 transition" dir="ltr">
                            {{ $settings->phone }}
                        </a>
                    </div>
                </div>
            @endif

            @if ($settings?->whatsapp_number)
                <div class="flex items-start gap-3">
                    <span class="text-xl">💬</span>
                    <div>
                        <p class="text-sm text-gray-500">واتساب</p>
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings->whatsapp_number) }}"
                           target="_blank"
                           class="font-medium hover:text-orange-600 transition" dir="ltr">
                            {{ $settings->whatsapp_number }}
                        </a>
                    </div>
                </div>
            @endif

        </div>

        @if (! $settings?->address && ! $settings?->phone && ! $settings?->whatsapp_number)
            <p class="text-center text-gray-400">لا توجد معلومات تواصل مضافة حاليًا.</p>
        @endif

    </div>

@endsection
