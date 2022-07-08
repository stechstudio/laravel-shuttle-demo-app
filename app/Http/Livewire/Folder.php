<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Folder as FolderModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use JsonException;
use Livewire\Component;

class Folder extends Component
{
    protected $listeners = [
        'uploadSuccess',
    ];

    public $uploadContext = [];

    public FolderModel $folder;

    public $fileUploads;

    public array $fileUpload = [];

    public bool $show = false;

    public function mount(): void
    {
        $this->uploadContext = ['folder_id' => $this->folder->id];

        $this->fileUploads = $this->getFileUploads();
    }

    public function render(): View
    {
        return view(view: 'livewire.folder');
    }

    public function getFileUploads(): Collection
    {
        return $this->folder->uploads;
    }

    /**
     * @throws JsonException
     */
    public function getFileUploadDetails($file): void
    {
        $attributes = json_decode(
            stripslashes(html_entity_decode($file)), associative: true, depth: 512, flags: JSON_THROW_ON_ERROR
        );

        $attributes['s3_url'] = Storage::temporaryUrl(path: $attributes['key'], expiration: now()->addMinutes(value: 10));

        $this->fileUpload = (array) $attributes;

        $this->togglePanel();
    }

    public function togglePanel(): void
    {
        $this->show = ! $this->show;
    }

    public function uploadSuccess($file): void
    {
        $this->fileUploads = $this->folder->uploads;

        $this->emit('refresh');
    }
}
