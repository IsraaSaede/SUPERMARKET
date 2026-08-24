<?php

use App\Services\CartService;
use Livewire\Component;
use App\Models\Product;

new class extends Component
{
    public int $productId;

    public int $quantity = 1;

    public function add(CartService $cart)
    {
        try {
            // جلب المنتج من قاعدة البيانات
            $product = Product::with('category')->findOrFail($this->productId);
            // إضافة المنتج للسلة
            $cart->add($this->productId, $this->quantity);
            // إرسال بيانات المنتج إلى المتصفح لتسجيلها في Google Analytics
            $this->dispatch('analytics-add-to-cart', [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => (float) $product->price,
                'category' => $product->category?->name,
                'quantity' => $this->quantity,
                'value' => (float) $product->price * $this->quantity,
            ]);
            $this->dispatch('cart-updated');
            $this->quantity = 1;
            $this->resetErrorBag('stock');
        } catch (\RuntimeException $e) {
            $this->addError('stock', $e->getMessage());
        }
    }
};
?>
<div class="mt-2">

    <div class="flex items-center gap-2">

        <div class="flex items-center border border-gray-200 rounded-lg">
            <button
                type="button"
                wire:click="decrement"
                class="w-7 h-7 flex items-center justify-center text-gray-500 hover:bg-gray-50 rounded-r-lg">
                −
            </button>

            <span class="w-8 text-center text-sm font-medium">
                {{ $quantity }}
            </span>

            <button
                type="button"
                wire:click="increment"
                class="w-7 h-7 flex items-center justify-center text-gray-500 hover:bg-gray-50 rounded-l-lg">
                +
            </button>
        </div>

        <button
            type="button"
            wire:click="add"
            wire:loading.attr="disabled"
            class="flex-1 bg-slate-900 text-white text-sm font-medium py-1.5 rounded-lg hover:bg-orange-600 transition disabled:opacity-50">

            <span wire:loading.remove wire:target="add">
                أضف للسلة
            </span>

            <span wire:loading wire:target="add">
                جاري الإضافة...
            </span>

        </button>

    </div>
@error('stock')
    <div class="mt-2 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-center text-sm text-red-700">
        {{ $message }}
    </div>
@enderror

</div>
