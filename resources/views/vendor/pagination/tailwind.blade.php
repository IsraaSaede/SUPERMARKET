@if ($paginator->hasPages())
    <nav class="flex justify-center mt-10" role="navigation" aria-label="Pagination Navigation">

        <div class="flex items-center gap-2 flex-wrap">

            {{-- السابق --}}
            @if ($paginator->onFirstPage())
                <span
                    class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed border">
                    السابق
                </span>
            @else
                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="px-4 py-2 rounded-xl border border-gray-300 bg-white hover:bg-orange-500 hover:text-white transition duration-200">
                    السابق
                </a>
            @endif

            {{-- أرقام الصفحات --}}
            @foreach ($elements as $element)

                @if (is_string($element))
                    <span class="px-2 text-gray-500">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span
                                class="w-11 h-11 rounded-xl bg-orange-500 text-white font-bold flex items-center justify-center shadow">
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $url }}"
                                class="w-11 h-11 rounded-xl border border-gray-300 bg-white hover:bg-orange-500 hover:text-white transition duration-200 flex items-center justify-center">
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach
                @endif

            @endforeach

            {{-- التالي --}}
            @if ($paginator->hasMorePages())
                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    class="px-4 py-2 rounded-xl border border-gray-300 bg-white hover:bg-orange-500 hover:text-white transition duration-200">
                    التالي
                </a>
            @else
                <span
                    class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed border">
                    التالي
                </span>
            @endif

        </div>

    </nav>
@endif
