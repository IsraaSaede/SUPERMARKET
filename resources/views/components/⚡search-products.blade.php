<?php

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

new class extends Component
{
    public string $query = '';

    public ?int $addedProductId = null;

    public function getResultsProperty()
    {
        if (strlen(trim($this->query)) < 2) {
            return collect();
        }

        return Product::where('is_active', true)
            ->where('name', 'like', '%' . $this->query . '%')
            ->limit(8)
            ->get();
    }

    public function addToCart(int $productId, CartService $cart)
    {
        try {
            $cart->add($productId, 1);
            $this->dispatch('cart-updated');
            $this->addedProductId = $productId;
        } catch (\RuntimeException $e) {
            $this->addError('stock', $e->getMessage());
        }
    }

    public function clear()
    {
        $this->query = '';
        $this->addedProductId = null;
    }
};
?>

<div class="relative w-full max-w-md" x-data="{ open: false }" x-on:click.outside="open = false">

    <div class="relative">
        <input
            type="text"
            wire:model.live.debounce.300ms="query"
            x-on:focus="open = true"
            placeholder="ابحث عن منتج..."
            class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-slate-900"
        >

        <span class="absolute top-1/2 -translate-y-1/2 right-3 text-gray-400">
            🔍
        </span>

        @if ($query)
            <button
                type="button"
                wire:click="clear"
                class="absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 hover:text-gray-600"
            >
                ✕
            </button>
        @endif
    </div>

    @if ($query && strlen(trim($query)) >= 2)
        <div x-show="open" class="absolute z-20 mt-1 w-full bg-white border border-gray-200 rounded-lg shadow-lg max-h-96 overflow-y-auto">

            @forelse ($this->results as $product)
                <div class="flex items-center gap-3 p-3 border-b border-gray-100 last:border-0">

                    <div class="w-10 h-10 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300 text-lg">🛒</div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ $product->name }}</p>
                        <p class="text-xs text-orange-600 font-bold">{{ number_format($product->price, 2) }} ل.س</p>
                    </div>

                    <button
                        type="button"
                        wire:click="addToCart({{ $product->id }})"
                        wire:loading.attr="disabled"
                        wire:target="addToCart({{ $product->id }})"
                        class="shrink-0 text-xs font-medium px-3 py-1.5 rounded-lg transition
                               {{ $addedProductId === $product->id ? 'bg-green-100 text-green-700' : 'bg-slate-900 text-white hover:bg-orange-600' }}"
                    >
                        @if ($addedProductId === $product->id)
                            أُضيف ✓
                        @else
                            أضف
                        @endif
                    </button>

                </div>
            @empty
                <p class="p-4 text-sm text-gray-400 text-center">لا توجد نتائج مطابقة</p>
            @endforelse

        </div>
    @endif

    @error('stock')
        <div class="absolute z-20 mt-1 w-full bg-red-50 text-red-600 text-xs rounded-lg p-2 text-center">
            {{ $message }}
        </div>
    @enderror

</div>
