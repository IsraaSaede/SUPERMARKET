<?php

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public int $totalQuantity = 0;

    public function mount(CartService $cart)
    {
        $this->totalQuantity = $cart->getTotalQuantity();
    }

    #[On('cart-updated')]
    public function refreshCount(CartService $cart)
    {
        $this->totalQuantity = $cart->getTotalQuantity();
    }
};
?>

<a href="{{ route('cart') }}" class="relative flex items-center gap-1 hover:text-orange-600 transition">
    <span class="text-xl">🛒</span>

    @if ($totalQuantity > 0)
        <span class="absolute -top-2 -left-2 bg-orange-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
            {{ $totalQuantity }}
        </span>
    @endif
</a>
