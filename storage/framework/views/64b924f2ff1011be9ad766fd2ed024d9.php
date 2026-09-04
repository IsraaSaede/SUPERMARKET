<?php
use App\Models\Setting;
use App\Services\CartService;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
?>

<div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasItems): ?>

        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <h3 class="text-lg font-bold mb-3">
                بيانات التوصيل
            </h3>

            
            <div class="flex flex-wrap gap-2 mb-4">
                <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-xs font-medium rounded-full px-3 py-1.5">
                    🚚 التوصيل خلال ساعة
                </span>
                <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full px-3 py-1.5">
                    💵 الدفع كاش عند الاستلام
                </span>
                <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-700 text-xs font-medium rounded-full px-3 py-1.5">
                    📱 أو عبر شام كاش
                </span>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['cart'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="bg-red-50 text-red-600 text-sm rounded-lg p-3 mb-4">
                    <?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($freeDeliveryThreshold && $deliveryFee > 0): ?>
                <div class="bg-orange-50 text-orange-700 text-sm rounded-lg p-3 mb-4">
                    أضف منتجات بقيمة
                    <?php echo e(number_format($freeDeliveryThreshold - $subtotal, 2)); ?>

                    ل.س للحصول على توصيل مجاني 🎉
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form wire:submit="submit" class="space-y-4">

                <div>
                    <label class="block text-sm font-medium mb-1">
                        الاسم الكامل
                    </label>

                    <input
                        type="text"
                        wire:model="name"
                        placeholder="مثال: عبدالباسط الساروت"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-900">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        العنوان الكامل
                    </label>

                    <textarea
                        wire:model="address"
                        rows="2"
                        placeholder="مثال: الخالدية، مقابل جنينة العلو ، بناء 12، طابق 7"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-slate-900"></textarea>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                        <span><?php echo e(number_format($subtotal, 2)); ?> ل.س</span>
                    </div>

                    <div class="flex justify-between">
                        <span>رسوم التوصيل</span>
                        <span>
                            <?php echo e($deliveryFee > 0 ? number_format($deliveryFee, 2) . ' ل.س' : 'مجاني 🎉'); ?>

                        </span>
                    </div>

                    <div class="flex justify-between font-bold">
                        <span>الإجمالي</span>
                        <span class="text-orange-600">
                            <?php echo e(number_format($grandTotal, 2)); ?> ل.س
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

                <p class="text-center text-xs text-gray-500 mt-2">
                    ✅ رح يوصلك تأكيد الطلب خلال دقائق، والتوصيل خلال ساعة، الدفع كاش أو شام كاش عند الاستلام
                </p>

            </form>

        </div>

    <?php else: ?>

        <div class="bg-white rounded-xl border border-gray-200 p-8 text-center text-gray-400">
            أضف منتجات للسلة أولاً لإتمام الطلب
        </div>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div><?php /**PATH C:\Users\ea084\Desktop\supermarket\storage\framework\views/livewire/views/c81fcf3c.blade.php ENDPATH**/ ?>