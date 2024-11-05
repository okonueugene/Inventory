<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    //list all employees
    public function index()
    {
        $employees = Employee::all();

        return response()->json($employees);
    }
}
