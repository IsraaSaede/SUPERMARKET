<x-filament-widgets::widget>

    <x-filament::section>

        <x-slot name="heading">
            أحدث المنتجات
        </x-slot>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($this->getProducts() as $product)

                <div
                    class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 p-4 shadow-sm hover:shadow-md transition">


                    <div class="flex items-center gap-4">

                        {{-- صورة المنتج --}}
                        <img
                            src="{{ $product->image }}"
                            class="w-20 h-20 rounded-xl object-cover border"
                        >


                        <div class="flex-1">

                            {{-- اسم المنتج --}}
                            <h3 class="font-bold text-gray-900 dark:text-white">
                                {{ $product->name }}
                            </h3>


                            {{-- التصنيف --}}
                            <span
                                class="inline-flex mt-1 px-2 py-1 text-xs rounded-lg bg-primary-50 text-primary-700">
                                {{ $product->category?->name ?? 'بدون تصنيف' }}
                            </span>


                        </div>

                    </div>



                    <div class="mt-4 grid grid-cols-2 gap-3">


                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">

                            <p class="text-xs text-gray-500">
                                السعر
                            </p>

                            <p class="font-bold">
                                {{ number_format($product->price) }}
                                ل.س
                            </p>

                        </div>



                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">

                            <p class="text-xs text-gray-500">
                                المخزون
                            </p>


                            <p
                                class="font-bold
                                @if($product->stock <= 5)
                                    text-danger-600
                                @elseif($product->stock <= 10)
                                    text-warning-600
                                @else
                                    text-success-600
                                @endif">

                                {{ $product->stock }}

                            </p>


                        </div>


                    </div>



                    <div class="mt-4">

                        @if($product->is_active)

                            <span
                                class="text-xs bg-success-100 text-success-700 px-3 py-1 rounded-full">
                                متوفر
                            </span>

                        @else

                            <span
                                class="text-xs bg-danger-100 text-danger-700 px-3 py-1 rounded-full">
                                مخفي
                            </span>

                        @endif


                    </div>


                </div>


            @endforeach


        </div>


    </x-filament::section>

</x-filament-widgets::widget>
