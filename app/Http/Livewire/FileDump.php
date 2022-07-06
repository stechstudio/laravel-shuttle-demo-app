<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Folder;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FileDump extends Component
{
    public $uploadContext = [];

    public $folder;

    public function mount(Folder $folder): void
    {
        $this->folder        = $folder;
        $this->uploadContext = ['folder_id' => $folder->id, 'foo' => 'bar'];
    }

    public function render(): View
    {
        return view(view: 'livewire.file-dump');
    }
}
