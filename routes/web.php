<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\FileDump;
use STS\Shuttle\Facades\Shuttle;

Auth::login(User::first());

Route::get(uri: '/folders/{folder}', action: FileDump::class);

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Shuttle::routes();
});
