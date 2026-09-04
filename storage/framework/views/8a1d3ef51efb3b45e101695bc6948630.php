<?php $__env->startSection('title', 'الرئيسية - ' . ($settings->store_name ?? 'سوبر ماركت')); ?>

<?php $__env->startSection('content'); ?>

    
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('cart-summary-button', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1051611616-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>


    
    <div class="mb-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-slate-600 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
        <span class="flex items-center gap-1.5 font-medium">
            💵 الدفع عند الاستلام كاش او شام كاش
        </span>
        <span class="hidden sm:inline text-slate-300">|</span>
        <span class="flex items-center gap-1.5">
            🚚 توصيل لجميع أحياء حمص
        </span>
    </div>


    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sliders->isNotEmpty()): ?>
        <section
            class="mb-14"
            x-data="{
                active: 0,
                total: <?php echo e($sliders->count()); ?>,
                timer: null,

                start() {
                    if (this.total > 1) {
                        this.timer = setInterval(() => {
                            this.active = (this.active + 1) % this.total;
                        }, 5000);
                    }
                },

                stop() {
                    clearInterval(this.timer);
                }
            }"
            x-init="start()"
            @mouseenter="stop()"
            @mouseleave="start()"
        >
            <div class="relative overflow-hidden rounded-2xl shadow-md bg-slate-100">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                    <?php
                        $sliderImage = $slider->image;

                        $sliderImageUrl = $sliderImage
                            ? (str_starts_with($sliderImage, 'http://') || str_starts_with($sliderImage, 'https://')
                                ? $sliderImage
                                : asset('storage/' . $sliderImage))
                            : null;
                    ?>

                    <div
                        x-show="active === <?php echo e($index); ?>"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        class="relative w-full aspect-[16/6] min-h-[220px] md:min-h-[300px] lg:min-h-[380px]"
                    >

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sliderImageUrl): ?>
                            <img
                                src="<?php echo e($sliderImageUrl); ?>"
                                alt="<?php echo e($slider->title ?? 'عرض'); ?>"
                                class="absolute inset-0 w-full h-full object-cover"
                            >
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slider->title || $slider->description): ?>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent flex flex-col justify-end p-5 md:p-8 lg:p-10">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slider->title): ?>
                                    <h2 class="text-white text-xl md:text-3xl lg:text-4xl font-bold drop-shadow-md">
                                        <?php echo e($slider->title); ?>

                                    </h2>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slider->description): ?>
                                    <p class="text-white/90 text-sm md:text-base lg:text-lg mt-2 max-w-2xl">
                                        <?php echo e($slider->description); ?>

                                    </p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sliders->count() > 1): ?>
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <button
                                type="button"
                                x-on:click="active = <?php echo e($index); ?>"
                                class="w-3 h-3 rounded-full transition-all"
                                :class="active === <?php echo e($index); ?>

                                    ? 'bg-white scale-110'
                                    : 'bg-white/50 hover:bg-white/80'"
                                aria-label="انتقل إلى الشريحة <?php echo e($index + 1); ?>"
                            ></button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($offers->isNotEmpty()): ?>
        <section class="mb-14">

            <div class="flex items-center gap-2 mb-6 bg-gradient-to-l from-orange-50 to-white border border-orange-100 rounded-2xl p-4 md:p-5">
                <span class="text-2xl">🔥</span>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900">
                        العروض الحالية
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        منتجات مختارة ضمن عروضنا الحالية
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-5 gap-4 md:gap-5 lg:gap-6">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                    <?php
                        $productImageUrl = $product->image_url;
                    ?>

                    <div class="group relative bg-white rounded-2xl border border-orange-200 shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300">

                        <span class="absolute top-2 right-2 z-10 bg-orange-600 text-white text-xs font-bold rounded-full px-2 py-1 shadow">
                            عرض خاص
                        </span>

                        <div class="aspect-square bg-slate-50 flex items-center justify-center overflow-hidden">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($productImageUrl): ?>
                                <img
                                    src="<?php echo e($productImageUrl); ?>"
                                    alt="<?php echo e($product->name); ?>"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                >
                            <?php else: ?>
                                <span class="text-slate-300 text-5xl">🛒</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>

                        <div class="p-4">

                            <p
                                class="font-semibold text-sm md:text-base text-slate-800 truncate"
                                title="<?php echo e($product->name); ?>"
                            >
                                <?php echo e($product->name); ?>

                            </p>

                            <p class="text-orange-600 font-bold text-base md:text-lg mt-1 mb-3">
                                <?php echo e(number_format($product->price, 2)); ?> ل.س
                            </p>

                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('add-to-cart-button', ['product-id' => $product->id]);

$__keyOuter = $__key ?? null;

$__key = 'offer-cart-btn-'.e($product->id).'';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1051611616-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

                        </div>

                    </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            </div>

        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bestSellers->isNotEmpty()): ?>
        <section class="mb-14">

            <div class="mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">
                    ⭐ الأكثر مبيعًا
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    المنتجات الأكثر طلبًا من عملائنا
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-5 gap-4 md:gap-5 lg:gap-6">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $bestSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                    <?php
                        $productImageUrl = $product->image_url;
                    ?>

                    <div class="group bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300">

                        <div class="aspect-square bg-slate-50 flex items-center justify-center overflow-hidden">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($productImageUrl): ?>
                                <img
                                    src="<?php echo e($productImageUrl); ?>"
                                    alt="<?php echo e($product->name); ?>"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                                >
                            <?php else: ?>
                                <span class="text-slate-300 text-5xl">🛒</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>

                        <div class="p-4">

                            <p
                                class="font-semibold text-sm md:text-base text-slate-800 truncate"
                                title="<?php echo e($product->name); ?>"
                            >
                                <?php echo e($product->name); ?>

                            </p>

                            <p class="text-orange-600 font-bold text-base md:text-lg mt-1 mb-3">
                                <?php echo e(number_format($product->price, 2)); ?> ل.س
                            </p>

                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('add-to-cart-button', ['product-id' => $product->id]);

$__keyOuter = $__key ?? null;

$__key = 'bestseller-cart-btn-'.e($product->id).'';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1051611616-2', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

                        </div>

                    </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            </div>

        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


    
    <section class="mb-14">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">
                    تسوق حسب الصنف
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    اختر الصنف الذي تبحث عنه
                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6 gap-4 lg:gap-5">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                <?php
                    $categoryImage = $category->image;

                    $categoryImageUrl = $categoryImage
                        ? (str_starts_with($categoryImage, 'http://') || str_starts_with($categoryImage, 'https://')
                            ? $categoryImage
                            : asset('storage/' . $categoryImage))
                        : null;
                ?>

                <a
                    href="<?php echo e(route('category.show', $category)); ?>"
                    class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-4 md:p-5 text-center"
                >

                    <div class="w-20 h-20 md:w-24 md:h-24 mx-auto mb-4 rounded-full overflow-hidden bg-slate-50 flex items-center justify-center">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($categoryImageUrl): ?>

                            <img
                                src="<?php echo e($categoryImageUrl); ?>"
                                alt="<?php echo e($category->name); ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            >

                        <?php else: ?>

                            <span class="text-slate-500 font-bold text-2xl">
                                <?php echo e(mb_substr($category->name, 0, 1)); ?>

                            </span>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                    <p class="font-semibold text-sm md:text-base text-slate-800 group-hover:text-orange-600 transition">
                        <?php echo e($category->name); ?>

                    </p>

                </a>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                <p class="text-slate-400 col-span-full text-center py-10">
                    لا توجد أصناف حالياً.
                </p>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

    </section>


    
    <section>

        <div class="flex items-end justify-between mb-6">

            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">
                    🆕 وصل حديثًا
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    أحدث المنتجات المضافة إلى المتجر
                </p>
            </div>

        </div>


        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-5 gap-4 md:gap-5 lg:gap-6">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                <div class="group bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300">

                    
                    <?php
                        $productImageUrl = $product->image_url;
                    ?>

                    <div class="aspect-square bg-slate-50 flex items-center justify-center overflow-hidden">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($productImageUrl): ?>

                            <img
                                src="<?php echo e($productImageUrl); ?>"
                                alt="<?php echo e($product->name); ?>"
                                class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                            >

                        <?php else: ?>

                            <span class="text-slate-300 text-5xl">
                                🛒
                            </span>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>


                    
                    <div class="p-4">

                        <p
                            class="font-semibold text-sm md:text-base text-slate-800 truncate"
                            title="<?php echo e($product->name); ?>"
                        >
                            <?php echo e($product->name); ?>

                        </p>

                        <p class="text-orange-600 font-bold text-base md:text-lg mt-1 mb-3">
                            <?php echo e(number_format($product->price, 2)); ?> ل.س
                        </p>

                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('add-to-cart-button', ['product-id' => $product->id]);

$__keyOuter = $__key ?? null;

$__key = 'cart-btn-'.e($product->id).'';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1051611616-3', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

                    </div>

                </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                <p class="text-slate-400 col-span-full text-center py-10">
                    لا توجد منتجات حالياً.
                </p>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

        <div class="mt-10 flex justify-center">
            <?php echo e($products->links('vendor.pagination.tailwind')); ?>

        </div>

    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ea084\Desktop\supermarket\resources\views/home.blade.php ENDPATH**/ ?>