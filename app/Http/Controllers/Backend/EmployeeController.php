<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // All Employee
    public function AllEmployee()
    {
        $employee = Employee::latest()->get();
        return view("backend.employee.all_employee", compact("employee"));
    }
}
