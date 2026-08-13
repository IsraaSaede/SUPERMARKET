<?php

use App\Models\Setting;
use App\Services\CartService;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|string|max:100')]
    public string $name = '';

    #[Validate('required|string|max:100')]
    public string $area = '';

    #[Validate('required|string|max:100')]
    public string $street = '';

    #[Validate('nullable|string|max:20')]
    public string $building = '';

    #[Validate('nullable|string|max:20')]
    public string $floor = '';

 #[Validate(['required', 'string', 'regex:/^(09\d{8}|(\+?963)9\d{8})$/'])]
public string $phone = '';

    #[Validate('nullable|string|max:500')]
    public string $notes = '';

    public function submit(CartService $cart)
    {
        $this->validate();

        $items = $cart->getDetailedItems();

        if ($items->isEmpty()) {
            $this->addError('cart', 'السلة فارغة، أضف منتجات أولاً.');
            return;
        }

        $settings = Setting::first();

        if (! $settings || ! $settings->whatsapp_number) {
            $this->addError('cart', 'رقم واتساب المحل غير مضبوط حاليًا.');
            return;
        }

        $subtotal = $cart->getTotalPrice();
        $deliveryFee = $this->calculateDeliveryFee($subtotal, $settings);
        $grandTotal = $subtotal + $deliveryFee;

        $message = $this->buildMessage($items, $subtotal, $deliveryFee, $grandTotal, $settings->store_name);

        $storeNumber = preg_replace('/\D/', '', $settings->whatsapp_number);

        $cart->clear();

        return redirect()->away(
            "https://wa.me/{$storeNumber}?text=" . urlencode($message)
        );
    }

    protected function calculateDeliveryFee(float $subtotal, Setting $settings): float
    {
        if ($settings->free_delivery_threshold !== null && $subtotal >= $settings->free_delivery_threshold) {
            return 0;
        }

        return (float) $settings->delivery_fee;
    }

    protected function buildMessage($items, float $subtotal, float $deliveryFee, float $grandTotal, ?string $storeName): string
    {
        $lines = [];

        $lines[] = "🛒 طلب جديد" . ($storeName ? " - {$storeName}" : '');
        $lines[] = '';
        $lines[] = '📋 بيانات الزبون:';
        $lines[] = "الاسم: {$this->name}";
        $lines[] = "الحي: {$this->area}";
        $lines[] = "الشارع: {$this->street}";

        if ($this->building) {
            $lines[] = "رقم العمارة: {$this->building}";
        }

        if ($this->floor) {
            $lines[] = "الطابق: {$this->floor}";
        }

        $lines[] = "رقم التواصل: {$this->phone}";

        if ($this->notes) {
            $lines[] = "ملاحظات: {$this->notes}";
        }

        $lines[] = '';
        $lines[] = '🧾 محتويات الطلب:';

        foreach ($items as $item) {
            $lines[] = "- {$item['product']->name} × {$item['quantity']} = " . number_format($item['subtotal'], 2) . ' ل.س';
        }

        $lines[] = '';
        $lines[] = 'المجموع الفرعي: ' . number_format($subtotal, 2) . ' ل.س';
        $lines[] = 'رسوم التوصيل: ' . ($deliveryFee > 0 ? number_format($deliveryFee, 2) . ' ل.س' : 'مجاني 🎉');
        $lines[] = 'الإجمالي الكلي: ' . number_format($grandTotal, 2) . ' ل.س';

        return implode("\n", $lines);
    }

   public function with(CartService $cart): array
{
    $settings = Setting::first();
    $subtotal = $cart->getTotalPrice();
    $deliveryFee = $settings ? $this->calculateDeliveryFee($subtotal, $settings) : 0;

    return [
        'subtotal' => $subtotal,
        'deliveryFee' => $deliveryFee,
        'grandTotal' => $subtotal + $deliveryFee,
        'freeDeliveryThreshold' => $settings->free_delivery_threshold ?? null,
        'hasItems' => $cart->getTotalQuantity() > 0,
    ];
}
#[On('cart-updated')]
    public function refresh(): void
    {
        // مفيش لازمة لأي كود جوه هنا
        // مجرد وجود الـ method ده بيخلي Livewire يعيد رسم الـ component ويستدعي with() تاني
    }
    protected function messages(): array
{
    return [
        'phone.regex' => 'رقم الهاتف غير صحيح. مثال: 0987654321 أو +963987654321',
    ];
}
};
?>
<div>

    @if ($hasItems)

        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <h3 class="text-lg font-bold mb-4">
                بيانات التوصيل
            </h3>

            @error('cart')
                <div class="bg-red-50 text-red-600 text-sm rounded-lg p-3 mb-4">
                    {{ $message }}
                </div>
            @enderror

            @if ($freeDeliveryThreshold && $deliveryFee > 0)
                <div class="bg-orange-50 text-orange-700 text-sm rounded-lg p-3 mb-4">
                    أضف منتجات بقيمة
                    {{ number_format($freeDeliveryThreshold - $subtotal,2) }}
                    ل.س للحصول على توصيل مجاني 🎉
                </div>
            @endif

            <form wire:submit="submit" class="space-y-4">

                <div>
                    <label class="block text-sm font-medium mb-1">
                        الاسم الكامل
                    </label>

                    <input
                        type="text"
                        wire:model="name"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-900">

                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        الحي
                    </label>

                    <input
                        type="text"
                        wire:model="area"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-900">

                    @error('area')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        اسم الشارع
                    </label>

                    <input
                        type="text"
                        wire:model="street"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-900">

                    @error('street')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-3">

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            رقم العمارة
                        </label>

                        <input
                            type="text"
                            wire:model="building"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-900">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            الطابق
                        </label>

                        <input
                            type="text"
                            wire:model="floor"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-900">
                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-1">
                        رقم التواصل
                    </label>

                    <input
                        type="tel"
                        wire:model="phone"
                        dir="ltr"
                        placeholder="0987654321"
                        class="w-full border rounded-lg px-3 py-2 text-left focus:outline-none focus:ring-2 focus:ring-slate-900">

                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div>

                    <label class="block text-sm font-medium mb-1">
                        ملاحظات
                    </label>

                    <textarea
                        wire:model="notes"
                        rows="2"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-900"></textarea>

                </div>

                <div class="border-t pt-4 space-y-2">

                    <div class="flex justify-between">
                        <span>المجموع الفرعي</span>
                        <span>{{ number_format($subtotal,2) }} ل.س</span>
                    </div>

                    <div class="flex justify-between">
                        <span>رسوم التوصيل</span>

                        <span>
                            {{ $deliveryFee > 0 ? number_format($deliveryFee,2).' ل.س' : 'مجاني 🎉' }}
                        </span>

                    </div>

                    <div class="flex justify-between font-bold">

                        <span>الإجمالي</span>

                        <span class="text-orange-600">
                            {{ number_format($grandTotal,2) }} ل.س
                        </span>

                    </div>

                </div>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full bg-slate-900 text-white py-3 rounded-lg hover:bg-orange-600 transition disabled:opacity-50">

                    <span wire:loading.remove wire:target="submit">
                        إرسال الطلب عبر واتساب
                    </span>

                    <span wire:loading wire:target="submit">
                        جاري التجهيز...
                    </span>

                </button>

            </form>

        </div>

    @else

        <div class="bg-white rounded-xl border border-gray-200 p-8 text-center text-gray-400">
            أضف منتجات للسلة أولاً لإتمام الطلب
        </div>

    @endif

</div>
