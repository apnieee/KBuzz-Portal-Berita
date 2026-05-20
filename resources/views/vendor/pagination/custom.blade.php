@if ($paginator->hasPages())
    <nav class="flex items-center justify-center mt-10">
        <ul class="flex items-center gap-2">

            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span
                        class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        Prev
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-primary hover:text-white transition">
                        Prev
                    </a>
                </li>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($elements as $element)

                {{-- "..." --}}
                @if (is_string($element))
                    <li>
                        <span class="px-4 py-2 text-sm text-gray-500">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Link Halaman --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())
                            <li>
                                <span
                                    class="px-4 py-2 text-sm text-white bg-primary rounded-lg">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-primary hover:text-white transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif

                    @endforeach
                @endif

            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-primary hover:text-white transition">
                        Next
                    </a>
                </li>
            @else
                <li>
                    <span
                        class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        Next
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif