<div class="relative z-10" role="dialog" aria-modal="true">
    <div
        x-transition:enter="ease-in-out duration-500"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in-out duration-500"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
    ></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="pointer-events-auto w-screen max-w-md"
                >
                    <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                        <div class="px-4 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">File Upload Information</h2>

                                <div class="ml-3 flex h-7 items-center">
                                    <button wire:click="togglePanel()" type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        <span class="sr-only">Close panel</span>

                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-6 w-6" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="relative mt-6 flex-1 px-4 sm:px-6">
                            <div class="absolute inset-0 px-4 sm:px-6">
                                @if ($fileUpload !== [])
                                    @if (str_contains(haystack: $fileUpload['type'], needle: 'image'))
                                        <div class="border-b-2 border-dashed py-4">
                                            <img src="{{ $fileUpload['s3_url'] }}" alt="Dynamic uploaded file" class="border">
                                        </div>
                                    @else
                                        <p class="border-b-2 border-dashed py-4">No preview is available for this file type</p>
                                    @endif
                                @endif

                                @foreach ($fileUpload as $key => $value)
                                    <p class="border-b-2 border-dashed py-4">
                                        <span class="uppercase">{{ str_replace(search: '_', replace: ' ', subject: $key) }}</span>:
                                        @if ($key === 's3_url')
                                            <a href="{{ $value }}" class="text-blue-500 hover:text-blue-600 hover:underline" target="_blank">View</a>
                                        @else
                                            {{ $value }}
                                        @endif
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
