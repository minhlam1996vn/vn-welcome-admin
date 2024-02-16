<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View The view for the admin dashboard.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
