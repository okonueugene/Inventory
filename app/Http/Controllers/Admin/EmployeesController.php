<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeesExport;
use App\Http\Controllers\Controller;
use App\Imports\EmployeesImport;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
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

    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function import(Request $request)
    {
        $rules = [
            'file' => 'required|mimes:xls,xlsx',
        ];

        $messages = [
            'file.required' => 'Please upload a file',
            'file.mimes' => 'Incorrect file extension',
        ];

        $request->validate($rules, $messages);

        try {
            DB::beginTransaction();

            Excel::import(new EmployeesImport, $request->file('file'));

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Employees imported successfully',
            ];

            return response()->json($output);

        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => false,
                'msg' => 'Something went wrong',
            ];

            return response()->json($output);
        } catch (ValidationException $e) {
            // Handle validation exception
            $errorMessage = implode(' & ', $e->validator->errors()->all());

            return redirect()->back()->with('error', $errorMessage);
        } catch (QueryException $e) {
            // Handle specific database exception (Integrity constraint violation)
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $errorMessage = 'Duplicate entry found. Please check your file for duplicate records.';
            } else {
                // Handle other database exceptions if needed
                $errorMessage = 'Database error during import.';
            }

            return redirect()->back()->with('error', $errorMessage);
        } catch (\Exception $e) {
            // Handle other generic exceptions
            $errorMessage = $this->getErrorMessage($e);

            return redirect()->back()->with('error', $errorMessage);
        }
    }
    private function getErrorMessage(\Exception $e): string
    {
        if ($e instanceof \Illuminate\Validation\ValidationException) {
            //format messages as html with line break
            $errorMessage = implode(' & ', $e->validator->errors()->all());

        } elseif ($e instanceof \Illuminate\Database\QueryException) {
            $errorMessage = 'Database error during import.';
        } else {
            $errorMessage = 'Error during import.';
        }

        return $errorMessage;
    }

}
