<?php
use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;
?>

<a href="<?php echo e(route('cart')); ?>" class="relative flex items-center gap-1 hover:text-orange-600 transition">
    <span class="text-xl">🛒</span>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalQuantity > 0): ?>
        <span class="absolute -top-2 -left-2 bg-orange-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
            <?php echo e($totalQuantity); ?>

        </span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</a><?php /**PATH C:\Users\ea084\Desktop\supermarket\storage\framework\views/livewire/views/815bdc2a.blade.php ENDPATH**/ ?>