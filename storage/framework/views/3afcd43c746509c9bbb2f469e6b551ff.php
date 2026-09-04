<?php
use App\Services\CartService;
use Livewire\Component;
use App\Models\Product;
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
                <?php echo e($quantity); ?>

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
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="mt-2 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-center text-sm text-red-700">
        <?php echo e($message); ?>

    </div>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div><?php /**PATH C:\Users\ea084\Desktop\supermarket\storage\framework\views/livewire/views/e75df42a.blade.php ENDPATH**/ ?>