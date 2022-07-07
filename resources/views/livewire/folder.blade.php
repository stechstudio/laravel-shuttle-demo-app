<div>
    <x-shuttle::uploader />

    <div x-data="FileUploadInformationPanel">
        <div x-show="show">
            <x-file-upload-information-panel :fileUpload="$fileUpload" />
        </div>

        <div class="p-10">
            <a href="{{ route('folders.index') }}" class="block text-center text-4xl items-center p-6 border-2 border-dashed mb-4">Click here to go back...</a>

            <p class="h-[200px] m-auto flex justify-center block text-center text-4xl items-center p-6 border-2 border-dashed mb-4">
                Drag your files here to begin the upload process
            </p>

            @forelse ($fileUploads as $fileUpload)
                <div class="block text-center text-4xl items-center p-6 border-2 border-dashed hover:bg-gray-100">
                    <div wire:click="getFileUploadDetails('{{ $fileUpload }}')" class="flex shrink-0 text-right justify-between items-center cursor-pointer">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>

                        {{ $fileUpload->name }}
                    </div>
                </div>
            @empty
                <p>There are currently no folders to display.</p>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('FileUploadInformationPanel', () => ({
            show: @entangle('show'),
        })
    )});
</script>
