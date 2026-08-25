<?php

use App\Services\CartService;
use Livewire\Component;

new class extends Component
{
public function increment(int $productId, CartService $cart)
{
    try {

        $items = $cart->getItems();

        $quantity = ($items[$productId]['quantity'] ?? 0) + 1;

        $cart->updateQuantity($productId, $quantity);

        $this->dispatch('cart-updated');

        $this->resetErrorBag('stock-' . $productId);

    } catch (\RuntimeException $e) {

        $this->addError('stock-' . $productId, $e->getMessage());

    }
}

    public function decrement(int $productId, CartService $cart)
    {
        $items = $cart->getItems();
        $quantity = ($items[$productId]['quantity'] ?? 1) - 1;

        $cart->updateQuantity($productId, $quantity);
        $this->dispatch('cart-updated');
    }

    public function remove(int $productId, CartService $cart)
    {
        $cart->remove($productId);
        $this->dispatch('cart-updated');
    }

    public function with(CartService $cart): array
    {
        return [
            'items' => $cart->getDetailedItems(),
            'total' => $cart->getTotalPrice(),
        ];
    }
};
?>

<div>
    @if ($items->isEmpty())
        <div class="text-center py-16">
            <p class="text-5xl mb-4">🛒</p>
            <p class="text-gray-500 mb-4">السلة فارغة الآن </p>
            <a href="{{ route('home') }}" class="text-slate-900 font-medium hover:text-orange-600 hover:underline">
                العودة للتسوق
            </a>
        </div>
    @else
        <div class="space-y-3">
            @foreach ($items as $item)
                <div class="bg-white rounded-xl border border-gray-200 p-3 flex items-center gap-3" wire:key="cart-item-{{ $item['product']->id }}">

                <div class="w-16 h-16 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">

                    @php
                        $image = $item['product']->image;

                        $imageUrl = $image
                            ? (
                                str_starts_with($image, 'http://') ||
                                str_starts_with($image, 'https://')
                                ? $image
                                : asset('storage/' . $image)
                            )
                            : null;
                    @endphp

                    @if ($imageUrl)
                        <img src="{{ $imageUrl }}"
                            alt="{{ $item['product']->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300 text-2xl">
                            🛒
                        </div>
                    @endif

                </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-sm truncate">{{ $item['product']->name }}</p>
                        <p class="text-orange-600 font-bold text-sm">{{ number_format($item['product']->price, 2) }} ل.س</p>
                    </div>

                    <div class="flex items-center border border-gray-200 rounded-lg">
                        <button
                            type="button"
                            wire:click="decrement({{ $item['product']->id }})"
                            class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-50"
                        >
                            −
                        </button>

                        <span class="w-8 text-center text-sm font-medium">{{ $item['quantity'] }}</span>

                        <button
                            type="button"
                            wire:click="increment({{ $item['product']->id }})"
                            class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-50"
                        >
                            +
                        </button>
                    </div>

                    <p class="w-20 text-left text-sm font-bold">{{ number_format($item['subtotal'], 2) }} ل.س</p>

                    <button
                        type="button"
                        wire:click="remove({{ $item['product']->id }})"
                        wire:confirm="هل تريد حذف هذا المنتج من السلة؟"
                        class="text-red-500 hover:text-red-700 text-lg px-2"
                    >
                        ✕
                    </button>
@if ($errors->has('stock-' . $item['product']->id))
    <p class="text-xs text-red-600 mt-2">
        {{ $errors->first('stock-' . $item['product']->id) }}
    </p>
@endif
       </div>
            @endforeach
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 mt-6 flex items-center justify-between">
            <span class="text-lg font-bold">الإجمالي</span>
            <span class="text-lg font-bold text-orange-600">{{ number_format($total, 2) }} ل.س</span>
        </div>

    @endif
</div>
