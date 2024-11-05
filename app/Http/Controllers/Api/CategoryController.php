<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //list all categories
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories);
    }
}
