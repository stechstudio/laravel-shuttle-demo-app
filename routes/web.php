<?php

declare(strict_types=1);

use App\Http\Livewire\FileBrowser;
use App\Http\Livewire\Folder;
use Illuminate\Support\Facades\Route;
use STS\Shuttle\Facades\Shuttle;

Route::redirect(uri: '/', destination: '/folders');
Route::get(uri: '/folders', action: FileBrowser::class)->name('folders.index');
Route::get(uri: '/folders/{folder}', action: Folder::class)->name('folders.show');

Route::middleware(['auth'])->group(function () {
    Shuttle::routes();
});
