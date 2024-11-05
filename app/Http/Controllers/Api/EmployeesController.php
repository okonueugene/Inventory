<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller
{
    //list all employees
    public function index()
    {
        $employees = Employee::all();

        return response()->json($employees);
    }
}
