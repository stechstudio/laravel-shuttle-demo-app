<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Folder as FolderModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use JsonException;
use Livewire\Component;
use Livewire\WithPagination;

class Folder extends Component
{
    use WithPagination;

    protected $listeners = [
        'uploadSuccess',
    ];

    public $uploadContext = [];

    public FolderModel $folder;

    public array $fileUpload = [];

    public bool $show = false;

    public function mount(): void
    {
        $this->uploadContext = ['folder_id' => $this->folder->id];
    }

    public function render(): View
    {
        return view(view: 'livewire.folder', data: [
            'fileUploads' => $this->getFileUploads(),
        ]);
    }

    public function getFileUploads(): LengthAwarePaginator
    {
        return $this->folder
            ->uploads()
            ->orderByDesc(column: 'created_at')
            ->paginate(perPage: 20);
    }

    /**
     * @throws JsonException
     */
    public function getFileUploadDetails($file): void
    {
        $attributes = json_decode(
            stripslashes(html_entity_decode($file)), associative: true, depth: 512, flags: JSON_THROW_ON_ERROR
        );

        $attributes['s3_url'] = Storage::temporaryUrl(path: $attributes['key'], expiration: now()->addMinutes(value: 15));

        $this->fileUpload = (array) $attributes;

        $this->togglePanel();
    }

    public function togglePanel(): void
    {
        $this->show = ! $this->show;
    }

    public function uploadSuccess($file): void
    {
        $this->emit('refresh');
    }
}
