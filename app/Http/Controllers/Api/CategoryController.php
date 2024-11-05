<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //list all categories
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories);
    }
}
