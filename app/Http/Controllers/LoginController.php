<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(): View
    {
        return view(view: 'login');
    }

    public function store()
    {
        Auth::login(user: User::first());

        return to_route(route: 'folders.index');
    }
}
