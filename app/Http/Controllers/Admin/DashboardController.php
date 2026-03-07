<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boletin;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBoletines = Boletin::count();
        return view('admin.dashboard', compact('totalBoletines'));
    }
}
