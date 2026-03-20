<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Importing BaseController

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        return view('admin.dashboard');
    }

    
}
