<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::orderBy('id', 'DESC')->get();

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
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\CategoryController@show', $row->id) . '"
                                        class="dropdown-item modal-button">View</a>
                                </li>
                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\CategoryController@edit', $row->id) . '"
                                        class="dropdown-item modal-button">Edit</a>
                                </li>
                                <li>
                                    <a href="#" data-href="' . action('App\Http\Controllers\Admin\CategoryController@destroy', [$row->id]) . '" class="dropdown-item delete-record">Delete</a>
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
                ->editColumn('description', function ($row) {
                    if ($row->description) {
                        //maximum 50 characters
                        return substr($row->description, 0, 50) . '...';
                    } else {
                        return 'N/A';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $page_title = 'Categories';

        return view('admin.categories.index', compact('page_title'));
    }



          

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Add Category';

        return view('admin.categories.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {

            DB::beginTransaction();

            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            $category->addNotification();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Category added successfully'
            ];

            return response()->json($output);

        } catch (\Exception $e) {
            DB::rollBack();
            $output = [
                'success' => false,
                'msg' => 'An error occurred while adding the category'
            ];

            return response()->json($output);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view ('admin.categories.show', compact('category'));
    }
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $page_title = 'Edit Category';

        return view('admin.categories.edit', compact('category', 'page_title'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        try {

            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->name = $request->name;  
            $category->description = $request->description;
            $category->save();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Category updated successfully'
            ];

            return response()->json($output);

        } catch (\Exception $e) {
            DB::rollBack();
            
            $output = [
                'success' => false,
                'msg' => 'An error occurred while updating the category'
            ];

            return response()->json($output);
        }
    }                                 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->delete();

            DB::commit();

            $output = [
                'success' => true,
                'msg' => 'Category deleted successfully'
            ];

            return response()->json($output);

        } catch (\Exception $e) {
            DB::rollBack();
            
            $output = [
                'success' => false,
                'msg' => 'An error occurred while deleting the category'
            ];

            return response()->json($output);
        }
    }
}

