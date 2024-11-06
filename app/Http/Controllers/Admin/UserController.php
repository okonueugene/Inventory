<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('id', 'desc')->get();

            return DataTables::of($data)
                ->addColumn(
                    'action',
                    function ($row) {
                        $html = ' <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown"
                                data-bs-display="static" aria-expanded="false">Action
                            </button>
                            <ul class="dropdown-menu">

                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\UserController@show', $row->id) . '"
                                        class="dropdown-item modal-button">View</a>
                                </li>
                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\UserController@edit', $row->id) . '"
                                        class="dropdown-item modal-button">Edit</a>
                                </li>
                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\UserController@destroy', [$row->id]) . '" class="dropdown-item delete-record">Delete</a>
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

        $page_title = 'Users';

        return view('admin.users.index', compact('page_title'));

    }

    public function create()
    {
        $page_title = 'Create User';

        return view('admin.users.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email,except,id',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',

        ];

        $request->validate($rules);

        try
        {
            DB::beginTransaction();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);

            $user->save();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'User created successfully',
            ];

            return response()->json($output);

        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => false,
                'msg' => 'User creation failed',
            ];

            return response()->json($output);
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable',
            'email' => 'nullable|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        try
        {
            DB::beginTransaction();

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'User updated successfully',
            ];

            return response()->json($output);

        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => false,
                'msg' => 'User update failed',
            ];

            return response()->json($output);
        }
    }

    public function destroy($id)
    {
        try
        {
            DB::beginTransaction();

            $user = User::find($id);
            $user->delete();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'User deleted successfully',
            ];

            return response()->json($output);

        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => false,
                'msg' => 'User deletion failed',
            ];

            return response()->json($output);
        }
    }

}
