<?php
use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;
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

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($query): ?>
            <button
                type="button"
                wire:click="clear"
                class="absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 hover:text-gray-600"
            >
                ✕
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($query && strlen(trim($query)) >= 2): ?>
        <div x-show="open" class="absolute z-20 mt-1 w-full bg-white border border-gray-200 rounded-lg shadow-lg max-h-96 overflow-y-auto">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="flex items-center gap-3 p-3 border-b border-gray-100 last:border-0">

                    <div class="w-10 h-10 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->image): ?>
                            <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                 alt="<?php echo e($product->name); ?>"
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-300 text-lg">🛒</div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate"><?php echo e($product->name); ?></p>
                        <p class="text-xs text-orange-600 font-bold"><?php echo e(number_format($product->price, 2)); ?> ل.س</p>
                    </div>

                    <button
                        type="button"
                        wire:click="addToCart(<?php echo e($product->id); ?>)"
                        wire:loading.attr="disabled"
                        wire:target="addToCart(<?php echo e($product->id); ?>)"
                        class="shrink-0 text-xs font-medium px-3 py-1.5 rounded-lg transition
                               <?php echo e($addedProductId === $product->id ? 'bg-green-100 text-green-700' : 'bg-slate-900 text-white hover:bg-orange-600'); ?>"
                    >
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($addedProductId === $product->id): ?>
                            أُضيف ✓
                        <?php else: ?>
                            أضف
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </button>

                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <p class="p-4 text-sm text-gray-400 text-center">لا توجد نتائج مطابقة</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="absolute z-20 mt-1 w-full bg-red-50 text-red-600 text-xs rounded-lg p-2 text-center">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div><?php /**PATH C:\Users\ea084\Desktop\supermarket\storage\framework\views/livewire/views/c7d6b92f.blade.php ENDPATH**/ ?>