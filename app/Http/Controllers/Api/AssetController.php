<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    // $table->string('name');
    // $table->foreignId('category_id')->constrained()->onDelete('cascade');
    // $table->foreignId('employee_id')->nullable()->constrained()->onDelete('set null');
    // $table->string('description')->nullable();
    // $table->string('code')->unique();
    // $table->string('serial_number')->nullable()->unique();
    // $table->string('status')->default('available');
    // $table->date('purchase_date')->nullable();
    // $table->date('warranty_date')->nullable();
    // $table->date('decommission_date')->nullable();
    // $table->string('latitude')->nullable();
    // $table->string('longitude')->nullable();

    public function index(Request $request)
    {
        $assets = Asset::with('category', 'employee')->get();

        return response()->json($assets);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|unique:assets',
        ]);

        $asset = Asset::create($request->all());

        return response()->json($asset, 201);
    }

    public function show($id)
    {
        $asset = Asset::with('category', 'employee')->findOrFail($id);

        return response()->json($asset);
        }                       
}
               