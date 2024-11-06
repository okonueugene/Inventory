<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::orderBy('id', 'desc')->get();

            return DataTables::of($data)
                ->addColumn(
                    'action',
                    function ($row) {
                        $html = '
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown"
                                data-bs-display="static" aria-expanded="false">Action
                            </button>
                            <ul class="dropdown-menu">

                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\EmployeesController@show', $row->id) . '"
                                        class="dropdown-item modal-button">View</a>
                                </li>
                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\EmployeesController@edit', $row->id) . '"
                                        class="dropdown-item modal-button">Edit</a>
                                </li>
                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\EmployeesController@destroy', [$row->id]) . '" class="dropdown-item delete-record">Delete</a>
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
                ->rawColumns(['action'])
                ->make(true);
        }

        $page_title = 'Employees';

        return view('admin.employees.index', compact('page_title'));
    }

    public function create()
    {
        $page_title = 'Create Employee';

        return view('admin.employees.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'location' => 'required',
        ];

        $request->validate($rules);

        try {
            DB::beginTransaction();

            $employee = new Employee();
            $employee->name = $request->name;
            $employee->department = $request->department;
            $employee->designation = $request->designation;
            $employee->location = $request->location;
            $employee->email = $request->email ?? null;

            $employee->save();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Employee added successfully',
            ];

            return response()->json($output);

        } catch (\Exception $e) {
            DB::rollBack();
            $output = [
                'success' => false,
                'msg' => 'Something went wrong',
            ];

            return response()->json($output);
        }

    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        $page_title = 'View Employee';

        return view('admin.employees.show', compact('employee', 'page_title'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        $page_title = 'Edit Employee';

        return view('admin.employees.edit', compact('employee', 'page_title'));
    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            $employee = Employee::findOrFail($id);
            $employee->name = $request->name;
            $employee->department = $request->department;
            $employee->designation = $request->designation;
            $employee->location = $request->location;
            $employee->email = $request->email ?? null;

            $employee->save();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Employee updated successfully',
            ];

            return response()->json($output);


        } catch (\Exception $e) {
            DB::rollBack();
            
            $output = [
                'success' => false,
                'msg' => 'Something went wrong',
            ];

            return response()->json($output);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $employee = Employee::findOrFail($id);
            $employee->delete();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Employee deleted successfully',
            ];

            return response()->json($output);

        } catch (\Exception $e) {
            DB::rollBack();
            
            $output = [
                'success' => false,
                'msg' => 'Something went wrong',
            ];

            return response()->json($output);
        }
    }

}
