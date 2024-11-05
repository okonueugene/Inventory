<?php

namespace App\Http\Controllers\Api;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'employee_id' => 'nullable|exists:employees,id',
            'description' => 'nullable',
            'code' => 'required|unique:assets',
            'serial_number' => 'nullable|unique:assets',
            'status' => 'required',
            'purchase_date' => 'nullable',
            'warranty_date' => 'nullable',
            'decommission_date' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ];

        $messages = [
            'category_id.exists' => 'The selected category is invalid.',
            'employee_id.exists' => 'The selected employee is invalid.',
        ];

        //use Validator facade to validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        //if the validation fails, return the error messages
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $asset = Asset::create($request->all());

        return response()->json($asset, 201);
    }

    public function show($id)
    {
        $asset = Asset::with('category', 'employee')->findOrFail($id);

        return response()->json($asset);
        }                       
}
               