<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    // @desc  Show login form
    // @route GET /login
    public function login(): View
    {
        return view('auth.login');
    }

    // @desc  Log in user
    // @route POST /authenticate
    public function authenticate(Request $request): string
    {
        return 'authenticate';
    }
}
