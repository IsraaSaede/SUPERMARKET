<?php
use App\Services\CartService;
use Livewire\Component;
use Livewire\Attributes\On;
?>

<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalQuantity > 0): ?>
        <div class="fixed bottom-0 inset-x-0 z-50 shadow-[0_-4px_20px_rgba(0,0,0,0.15)]">
            <a
                href="<?php echo e(route('cart')); ?>"
                wire:navigate
                class="flex items-center justify-between gap-3 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white px-4 py-4 md:px-8 md:py-5 transition-colors duration-200 max-w-5xl mx-auto"
            >
                <div class="flex items-center gap-3">
                    <span class="relative flex items-center justify-center w-11 h-11 md:w-12 md:h-12 rounded-full bg-white/20 text-xl">
                        🛒
                        <span class="absolute -top-1.5 -left-1.5 bg-white text-emerald-700 text-xs font-extrabold rounded-full min-w-5 h-5 px-1 flex items-center justify-center border-2 border-emerald-600">
                            <?php echo e($totalQuantity); ?>

                        </span>
                    </span>

                    <div class="leading-tight text-right">
                        <p class="font-extrabold text-base md:text-xl">
                            اطلب الآن
                        </p>
                        <p class="text-emerald-50 text-xs md:text-sm">
                            المنتجات <?php echo e(number_format($subtotal, 0)); ?> + توصيل <?php echo e(number_format($deliveryFee, 0)); ?> ل.س
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <span class="font-extrabold text-lg md:text-2xl whitespace-nowrap">
                        <?php echo e(number_format($grandTotal, 0)); ?> ل.س
                    </span>
                    <span class="text-2xl">←</span>
                </div>
            </a>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH C:\Users\ea084\Desktop\supermarket\storage\framework\views/livewire/views/f8613ad5.blade.php ENDPATH**/ ?>