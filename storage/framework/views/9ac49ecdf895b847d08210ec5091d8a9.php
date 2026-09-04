<?php
use App\Services\CartService;
use Livewire\Component;
?>

<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($items->isEmpty()): ?>
        <div class="text-center py-16">
            <p class="text-5xl mb-4">🛒</p>
            <p class="text-gray-500 mb-4">السلة فارغة الآن </p>
            <a href="<?php echo e(route('home')); ?>" class="text-slate-900 font-medium hover:text-orange-600 hover:underline">
                العودة للتسوق
            </a>
        </div>
    <?php else: ?>
        <div class="space-y-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="bg-white rounded-xl border border-gray-200 p-3 flex items-center gap-3" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'cart-item-'.e($item['product']->id).''; ?>wire:key="cart-item-<?php echo e($item['product']->id); ?>">

                <div class="w-16 h-16 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">

                    <?php
                        $image = $item['product']->image;

                        $imageUrl = $image
                            ? (
                                str_starts_with($image, 'http://') ||
                                str_starts_with($image, 'https://')
                                ? $image
                                : asset('storage/' . $image)
                            )
                            : null;
                    ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imageUrl): ?>
                        <img src="<?php echo e($imageUrl); ?>"
                            alt="<?php echo e($item['product']->name); ?>"
                            class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-gray-300 text-2xl">
                            🛒
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-sm truncate"><?php echo e($item['product']->name); ?></p>
                        <p class="text-orange-600 font-bold text-sm"><?php echo e(number_format($item['product']->price, 2)); ?> ل.س</p>
                    </div>

                    <div class="flex items-center border border-gray-200 rounded-lg">
                        <button
                            type="button"
                            wire:click="decrement(<?php echo e($item['product']->id); ?>)"
                            class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-50"
                        >
                            −
                        </button>

                        <span class="w-8 text-center text-sm font-medium"><?php echo e($item['quantity']); ?></span>

                        <button
                            type="button"
                            wire:click="increment(<?php echo e($item['product']->id); ?>)"
                            class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-50"
                        >
                            +
                        </button>
                    </div>

                    <p class="w-20 text-left text-sm font-bold"><?php echo e(number_format($item['subtotal'], 2)); ?> ل.س</p>

                    <button
                        type="button"
                        wire:click="remove(<?php echo e($item['product']->id); ?>)"
                        wire:confirm="هل تريد حذف هذا المنتج من السلة؟"
                        class="text-red-500 hover:text-red-700 text-lg px-2"
                    >
                        ✕
                    </button>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->has('stock-' . $item['product']->id)): ?>
    <p class="text-xs text-red-600 mt-2">
        <?php echo e($errors->first('stock-' . $item['product']->id)); ?>

    </p>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
       </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 mt-6 flex items-center justify-between">
            <span class="text-lg font-bold">الإجمالي</span>
            <span class="text-lg font-bold text-orange-600"><?php echo e(number_format($total, 2)); ?> ل.س</span>
        </div>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH C:\Users\ea084\Desktop\supermarket\storage\framework\views/livewire/views/b8a15350.blade.php ENDPATH**/ ?>