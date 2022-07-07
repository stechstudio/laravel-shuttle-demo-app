<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use STS\Shuttle\Facades\Shuttle;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @noinspection PhpUndefinedMethodInspection
     */
    public function boot(): void
    {
        Model::unguard();

        Shuttle::resolveOwnerWith(fn (array $meta) => Folder::findOrFail($meta['folder_id']));
    }
}
