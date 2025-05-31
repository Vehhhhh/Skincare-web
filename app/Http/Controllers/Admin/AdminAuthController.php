<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    function index(): View
    {
        return view('admin.auth.login');
    }
    function forgotPassword(): View
    {
        return view('admin.auth.forgot-password');
    }
}
