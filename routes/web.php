<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\FileDump;
use STS\Shuttle\Facades\Shuttle;

Route::get(uri: '/folders/{folder}', action: FileDump::class);

/** @noinspection PhpUndefinedMethodInspection */
Shuttle::routes();
