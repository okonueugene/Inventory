<?php

namespace App\Http\Controllers\Admin;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return view('admin.assets.create', compact('page_title'));
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

        try {

            DB::beginTransaction();

            $asset = Asset::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'employee_id' => $request->employee_id,
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

            return redirect()->route('admin.assets.index')->with('success', 'Asset created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.assets.index')->with('error', 'An error occurred while creating the asset');
        }
    }

        public function show($id)
        {
            $asset = Asset::with('category', 'employee')->findOrFail($id);

            return view('admin.assets.show', compact('asset'));
        }

        public function edit($id)
        {
            $asset = Asset::findOrFail($id);

            $page_title = 'Edit Asset';

            return view('admin.assets.edit', compact('asset', 'page_title'));
        }

        public function update(Request $request, $id)
        {
            $rules = [
                'name' => 'required',
                'category_id' => 'required|exists:categories,id',
                'employee_id' => 'nullable|exists:employees,id',
                'description' => 'nullable',
                'code' => 'required|unique:assets,code,' . $id,
                'serial_number' => 'nullable|unique:assets,serial_number,' . $id,
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

            try {

                DB::beginTransaction();

                $asset = Asset::findOrFail($id);

                $asset->update([
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                    'employee_id' => $request->employee_id,
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

                return redirect()->route('admin.assets.index')->with('success', 'Asset updated successfully');
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->route('admin.assets.index')->with('error', 'An error occurred while updating the asset');
            }
        }

        public function destroy($id)
        {
            try {

                DB::beginTransaction();

                $asset = Asset::findOrFail($id);

                $asset->delete();

                DB::commit();

                return redirect()->route('admin.assets.index')->with('success', 'Asset deleted successfully');
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->route('admin.assets.index')->with('error', 'An error occurred while deleting the asset');
            }
        }
}