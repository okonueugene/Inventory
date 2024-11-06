<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $page_title = 'Dashboard';

        return view('admin.dashboard.index', compact('page_title'));
    }
}
