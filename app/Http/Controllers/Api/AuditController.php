<?php

namespace App\Http\Controllers\Api;

use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id'
        ]);

        try 
        {
            DB::beginTransaction();

            $audit = new Audit();
            $audit->asset_id = $request->asset_id;
            $audit->user_id = auth()->user()->id;
            $audit->status = $request->status;
            $audit->remarks = $request->remarks;
            $audit->condition = $request->condition;
            $audit->action = $request->action;
            $audit->status = 0;

            $audit->save();

            $audit->addNotification();

            DB::commit();

            return response()->json($audit, 201);
        }
        catch (\Exception $e) 
        {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Audit $audit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Audit $audit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Audit $audit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audit $audit)
    {
        //
    }
}
