@extends('layouts.app')

@section('title', 'السلة')

@section('content')
    <h2 class="text-2xl font-bold mb-5 text-slate-900">السلة</h2>

    <livewire:cart-page />

    <div class="mt-8">
        <livewire:checkout-form />
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        gtag('event', 'view_cart');

    });
</script>

@endsection

