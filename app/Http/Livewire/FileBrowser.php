<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Folder;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FileBrowser extends Component
{
    public function render(): View
    {
        return view(view: 'livewire.file-browser', data: [
            'folders' => Folder::all(),
        ]);
    }
}
