<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $page_title = 'Reports';

        return view('admin.reports.index', compact('page_title'));
    }
}
