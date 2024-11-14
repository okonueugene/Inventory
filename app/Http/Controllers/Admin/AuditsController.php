<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AuditsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Audit::with('asset', 'user')->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                ->addColumn(
                    'action',
                    function ($row) {
                        $row->load('asset', 'user');
                        $html = '
                    <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown"
                                data-bs-display="static" aria-expanded="false">Action
                            </button>
                            <ul class="dropdown-menu">

                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\AuditsController@show', $row->id) . '"
                                        class="dropdown-item modal-button">View</a>
                                </li>
                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\AuditsController@edit', $row->id) . '"
                                        class="dropdown-item modal-button">Edit</a>
                                </li>
                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\AuditsController@destroy', [$row->id]) . '" class="dropdown-item delete-record">Delete</a>

                                </li>
                            </ul>
                        </div>
                    ';
                        return $html;
                    }
                )
                ->addColumn('serial_no', function ($row) {
                    static $serialNumber = 0;
                    $serialNumber++;
                    return $serialNumber;
                })
                ->addColumn('asset', function ($row) {
                    return $row->asset->name ?? 'N/A';
                })
                ->addColumn('auditor', function ($row) {
                    return $row->user->name ?? 'N/A';
                })
                ->addColumn('status', function ($row) {
                    $html = $row->status == 1 ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-danger">Not Available</span>';
                    return $html;
                })
                ->editColumn('done_at', function ($row) {
                    return $row->created_at->format('d M Y');
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $page_title = 'Audits';

        return view('admin.audits.index', compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Audit $audit)
    {
        $audit->load('asset', 'user');

        return view('admin.audits.show', compact('audit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Audit $audit)
    {
        $audit->load('asset', 'user');

        return view('admin.audits.edit', compact('audit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();

            $audit = Audit::findOrFail($id);
            
            $audit->user_id = auth()->user()->id;
            $audit->status = $request->status;
            $audit->remarks = $request->remarks;
            $audit->condition = $request->condition;
            $audit->action = $request->action;
            $audit->done_at = $request->done_at;

            $audit->save();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Audit updated successfully',
            ];

            return response()->json($output, 200);
        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => false,
                'msg' => 'An error occurred while updating audit',
            ];

            return response()->json($output, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audit $audit)
    {
        try {

            DB::beginTransaction();

            $audit->delete();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Audit deleted successfully',
            ];

            return response()->json($output, 200);

        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => false,
                'msg' => 'An error occurred while deleting audit',
            ];

            return response()->json($output, 400);
        }

    }
}
