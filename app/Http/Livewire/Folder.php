<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Folder as FolderModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Folder extends Component
{
    protected function getListeners(): array
    {
        return [
            'uploadSuccess' => '$refresh',
        ];
    }

    public $uploadContext = [];

    public FolderModel $folder;

    public $fileUploads;

    public $fileUpload;

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

    public function getFileUploadDetails($file): void
    {
        $this->fileUpload = $file;

        $this->togglePanel();
    }

    public function togglePanel(): void
    {
        $this->show = ! $this->show;
    }
}
