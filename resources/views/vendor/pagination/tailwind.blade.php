@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center mt-10">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between w-full max-w-2xl">
            {{-- Info de resultados --}}
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    {!! __('Mostrando') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium text-red-800 dark:text-red-400">{{ $paginator->firstItem() }}</span>
                        {!! __('a') !!}
                        <span class="font-medium text-red-800 dark:text-red-400">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('de') !!}
                    <span class="font-medium text-red-800 dark:text-red-400">{{ $paginator->total() }}</span>
                    {!! __('resultados') !!}
                </p>
            </div>

            {{-- Paginación --}}
            <div>
                <span class="relative z-0 inline-flex rounded-md shadow-sm">
                    {{-- Botón anterior --}}
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-l-md cursor-default dark:bg-gray-700 dark:text-gray-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 0 1 0 1.414L9.414 10l3.293 3.293a1 1 0 1 1-1.414 1.414l-4-4a1 1 0 0 1 0-1.414l4-4a1 1 0 0 1 1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-red-700 bg-white border border-gray-300 rounded-l-md hover:bg-red-100 hover:text-red-900 dark:bg-gray-800 dark:text-red-300 dark:border-gray-600 dark:hover:bg-red-900 dark:hover:text-red-200" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 0 1 0 1.414L9.414 10l3.293 3.293a1 1 0 1 1-1.414 1.414l-4-4a1 1 0 0 1 0-1.414l4-4a1 1 0 0 1 1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    @endif

                    {{-- Números de página --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 cursor-default dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600">{{ $element }}</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-red-800 border border-gray-300 cursor-default dark:bg-red-700 dark:border-gray-600">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-red-800 bg-white border border-gray-300 hover:bg-red-100 hover:text-red-900 dark:bg-gray-800 dark:text-red-300 dark:border-gray-600 dark:hover:bg-red-900 dark:hover:text-red-200" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Botón siguiente --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-red-800 bg-white border border-gray-300 rounded-r-md hover:bg-red-100 hover:text-red-900 dark:bg-gray-800 dark:text-red-300 dark:border-gray-600 dark:hover:bg-red-900 dark:hover:text-red-200" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 0 1 0-1.414L10.586 10 7.293 6.707a1 1 0 1 1 1.414-1.414l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    @else
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-r-md cursor-default dark:bg-gray-700 dark:text-gray-500 dark:border-gray-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 0 1 0-1.414L10.586 10 7.293 6.707a1 1 0 1 1 1.414-1.414l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
