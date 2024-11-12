<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
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

        $coordinates = $request->coordinates;
        $latitude = null;
        $longitude = null;
    
        if ($coordinates) {
            // Assuming coordinates format is always "latitude,longitude"
            [$latitude, $longitude] = explode(',', $coordinates);
        }

        try{

            DB::beginTransaction();
    

        $asset = Asset::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'employee_id' => $request->employee_id,
            'user_id' => auth()->user()->id ?? 1,
            'description' => $request->description,
            'code' => $request->code,
            'serial_number' => $request->serial_number,
            'status' => $request->status,
            'purchase_date' => $request->purchase_date,
            'warranty_date' => $request->warranty_date,
            'decommission_date' => $request->decommission_date,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {
            $asset->addMediaFromRequest('image')->toMediaCollection('asset_images');
        }

        DB::commit();

        $output = [
            'success' => true,
            'message' => 'Asset created successfully',
            'data' => $asset
        ];

        return response()->json($output, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            $output = [
                'success' => false,
                'message' => 'Asset creation failed',
                'error' => $e->getMessage()
            ];

            return response()->json($output, 400);
        }
    }

    public function show($id)
    {
        $asset = Asset::with('category', 'employee')->where('code', $id)->first();

        if (!$asset) {
            return response()->json(['message' => 'Asset not found'], 200);
        }

        return response()->json($asset);
    }

    public function update(Request $request, $id)
    {
    
        try {
            DB::beginTransaction();

            $asset = Asset::where('code', $id)->first();

            if (!$asset) {
                return response()->json(['message' => 'Asset not found'], 404);
            }

            $coordinates = $request->coordinates;
            $latitude = null;
            $longitude = null;

    
            if ($coordinates) {
                // Assuming coordinates format is always "latitude,longitude"
                [$latitude, $longitude] = explode(',', $coordinates);
            }
    

            //update the asset
            $asset->update([
                'user_id' => auth()->user()->id,
                'description' => $request->description,
                'serial_number' => $request->serial_number,
                'purchase_date' => $request->purchase_date,
                'warranty_date' => $request->warranty_date,
                'decommission_date' => $request->decommission_date,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
            

            DB::commit();

            $output = [
                'success' => true,
                'message' => 'Asset updated successfully',
                'data' => $asset
            ];

            return response()->json($output, 200);

        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => false,
                'message' => 'Asset update failed',
                'error' => $e->getMessage()
            ];

            return response()->json($output, 400);
        }
    }
}
