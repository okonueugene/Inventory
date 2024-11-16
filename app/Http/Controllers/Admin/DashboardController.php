<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Audit;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];

        //Total Assets
        $data['total_assets'] = Asset::count() ?? 0;
        //Total Employees
        $data['total_employees'] = Employee::count() ?? 0;
        //Total Categories
        $data['total_categories'] = Category::count() ?? 0;
        //Total Audit Logs
        $data['total_audit_logs'] = Audit::count() ?? 0;

        $page_title = 'Dashboard';

        return view('admin.dashboard.index', compact('page_title', 'data'));
    }

    public function getLatestAssets(Request $request)
    {
        if ($request->ajax()) {
            $data = Asset::orderBy('id', 'desc')->limit(5)->get();
            return DataTables::of($data)
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('employee', function ($row) {
                    return $row->employee->name ?? 'N/A';
                })
                ->addColumn('status', function ($row) {
                    $html = $row->status == 1 ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-danger">Not Available</span>';
                    return $html;
                })
                ->addColumn('serial_no', function ($row) {
                    static $serialNumber = 0;
                    $serialNumber++;
                    return $serialNumber;
                })

                ->rawColumns(['status'])
                ->make(true);
        }
    }
}
