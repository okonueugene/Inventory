<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Asset::with('category', 'employee')->get();

            return DataTables::of($data)
                ->addColumn(
                    'action',
                    function ($row) {
                        $row->load('media');
                        $html = '
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown"
                                data-bs-display="static" aria-expanded="false">Action
                            </button>
                            <ul class="dropdown-menu">

                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\AssetController@show', $row->id) . '"
                                        class="dropdown-item modal-button">View</a>
                                </li>
                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\AssetController@edit', $row->id) . '"
                                        class="dropdown-item modal-button">Edit</a>
                                </li>
                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\AssetController@destroy', [$row->id]) . '" class="dropdown-item delete-record">Delete</a>

                                </li>
                            </ul>
                        </div>
                    ';
                        return $html;
                    }
                )
                ->editColumn('serial_number', function ($row) {
                    return $row->serial_number ?? 'N/A';
                })

                ->addColumn('serial_no', function ($row) {
                    static $serialNumber = 0;
                    $serialNumber++;
                    return $serialNumber;
                })
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('employee', function ($row) {
                    return $row->employee->name;
                })
                ->addColumn('status', function ($row) {
                    $html = $row->status == 'available' ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-danger">Not Available</span>';
                    return $html;
                })

                ->rawColumns(['action', 'status'])
                ->make(true);

        }

        $page_title = 'Assets';

        return view('admin.assets.index', compact('page_title'));
    }

    public function create()
    {
        $page_title = 'Create Asset';

        $categories = Category::all();

        $employees = Employee::all();

        return view('admin.assets.create', compact('page_title', 'categories', 'employees'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'category' => 'required|exists:categories,id',
            'employee' => 'nullable|exists:employees,id',
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
            'category.exists' => 'The selected category is invalid.',
            'employee.exists' => 'The selected employee is invalid.',
        ];

        //use Validator facade to validate the request
        $validator = Validator::make($request->all(), $rules, $messages);

        //if the validation fails, return the error messages
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {

            DB::beginTransaction();

            $asset = Asset::create([
                'name' => $request->name,
                'category_id' => $request->category,
                'employee_id' => $request->employee,
                'user_id' => auth()->user()->id,
                'description' => $request->description,
                'code' => $request->code,
                'serial_number' => $request->serial_number,
                'status' => $request->status,
                'purchase_date' => $request->purchase_date,
                'warranty_date' => $request->warranty_date,
                'decommission_date' => $request->decommission_date,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            if ($request->hasFile('image')) {
                $asset->addMediaFromRequest('image')->toMediaCollection('asset_images');
            }

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Asset created successfully',
            ];

            return response()->json($output, 200);

        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => false,
                'msg' => 'An error occurred while creating the asset',
            ];

            return response()->json($output, 400);
        }
    }

    public function show($id)
    {
        $asset = Asset::with('category', 'employee', 'user')->findOrFail($id);

        return view('admin.assets.show', compact('asset'));
    }

    public function edit($id)
    {
        $asset = Asset::findOrFail($id);

        $employees = Employee::all();

        $categories = Category::all();

        $page_title = 'Edit Asset';

        return view('admin.assets.edit', compact('asset', 'page_title', 'employees', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $asset = Asset::findOrFail($id);

            $asset->update([
                'name' => $request->name,
                'category_id' => $request->category,
                'employee_id' => $request->employee,
                'description' => $request->description,
                'code' => $request->code,
                'serial_number' => $request->serial_number,
                'status' => $request->status,
                'purchase_date' => $request->purchase_date,
                'warranty_date' => $request->warranty_date,
                'decommission_date' => $request->decommission_date,
            ]);

            if ($request->hasFile('image')) {
                $asset->addMediaFromRequest('image')->toMediaCollection('asset_images');
            }

            // DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Asset updated successfully',
            ];

            return response()->json($output, 200);

        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => false,
                'msg' => 'An error occurred while updating the asset',
            ];

            return response()->json($output, 400);
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $asset = Asset::findOrFail($id);

            $asset->delete();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Asset deleted successfully',
            ];

            return response()->json($output, 200);

        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => false,
                'msg' => 'An error occurred while deleting the asset',
            ];

            return response()->json($output, 400);
        }
    }
}
