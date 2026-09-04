<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use RuntimeException;

class CartService
{
    protected string $sessionKey = 'cart';

    public function getItems(): array
    {
        return session($this->sessionKey, []);
    }

    public function add(int $productId, int $quantity = 1): void
    {
        $product = Product::findOrFail($productId);

        if ($product->stock <= 0) {
            throw new RuntimeException('عذراً، هذا المنتج نفد من المخزون.');
        }

        $cart = $this->getItems();

        $currentQuantity = $cart[$productId]['quantity'] ?? 0;
        $newQuantity = $currentQuantity + $quantity;

        if ($newQuantity > $product->stock) {
            throw new RuntimeException("الكمية المتوفرة فقط {$product->stock} قطعة.");
        }

        $cart[$productId] = [
            'quantity' => $newQuantity,
        ];

        session([$this->sessionKey => $cart]);
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        $cart = $this->getItems();

        if (! isset($cart[$productId])) {
            return;
        }

        if ($quantity <= 0) {
            $this->remove($productId);
            return;
        }

        $product = Product::findOrFail($productId);

        if ($product->stock <= 0) {
            $this->remove($productId);

            throw new RuntimeException('هذا المنتج أصبح غير متوفر.');
        }

        if ($quantity > $product->stock) {
            throw new RuntimeException("الكمية المتوفرة فقط {$product->stock} قطعة.");
        }

        $cart[$productId]['quantity'] = $quantity;

        session([$this->sessionKey => $cart]);
    }

    public function remove(int $productId): void
    {
        $cart = $this->getItems();

        unset($cart[$productId]);

        session([$this->sessionKey => $cart]);
    }

    public function clear(): void
    {
        session()->forget($this->sessionKey);
    }

    public function getTotalQuantity(): int
    {
        return array_sum(array_column($this->getItems(), 'quantity'));
    }

    public function getDetailedItems(): Collection
    {
        $cart = $this->getItems();

        if (empty($cart)) {
            return collect();
        }

        $products = Product::whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        return collect($cart)
            ->map(function ($item, $productId) use ($products) {

                $product = $products->get($productId);

                if (! $product) {
                    return null;
                }

                // إذا أصبح المنتج غير متوفر نحذفه من السلة
                if ($product->stock <= 0) {
                    $this->remove($productId);
                    return null;
                }

                // إذا تغير المخزون وأصبح أقل من الكمية الموجودة
                if ($item['quantity'] > $product->stock) {

                    $cart = $this->getItems();
                    $cart[$productId]['quantity'] = $product->stock;
                    session([$this->sessionKey => $cart]);

                    $item['quantity'] = $product->stock;
                }

                return [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ];
            })
            ->filter();
    }

    public function getTotalPrice(): float
    {
        return $this->getDetailedItems()->sum('subtotal');
    }

    /**
     * رسم توصيل ثابت يُقرأ من config/cart.php (وليس من قاعدة البيانات).
     * صفر إذا كانت السلة فارغة.
     */
    public function getDeliveryFee(): float
    {
        if ($this->getTotalQuantity() === 0) {
            return 0.0;
        }

        return (float) config('cart.delivery_fee', 0);
    }

    /**
     * إجمالي المنتجات + التوصيل.
     */
    public function getGrandTotal(): float
    {
        return $this->getTotalPrice() + $this->getDeliveryFee();
    }
}
