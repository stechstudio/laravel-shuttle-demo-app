<div class="p-10">
    <h1 class="block text-center text-4xl items-center p-6 border-2 border-dashed mb-4">Click on a folder to upload files.</h1>

    @forelse ($folders as $folder)
        <a href="{{ route('folders.show', $folder) }}" class="block text-center text-4xl items-center p-6 border-2 border-dashed hover:bg-gray-100">
            <div class="flex shrink-0 text-right justify-between items-center">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>

                {{ $folder->name }}
            </div>
        </a>
    @empty
        <p>There are currently no folders to display.</p>
    @endforelse
</div>
