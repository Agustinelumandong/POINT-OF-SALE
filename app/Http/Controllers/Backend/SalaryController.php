<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use Carbon\Carbon;

class SalaryController extends Controller
{
    public function AddAdvanceSalary()
    {
        $employee = Employee::latest()->get();
        return view('backend.salary.add_advance_salary', compact('employee'));
    }

    public function AdvanceSalaryStore(Request $request)
    {

        $validateData = $request->validate([
            'month' => 'required',
            'year' => 'required',
        ]);

        $month = $request->month;
        $employee_id = $request->employee_id;

        $advance = AdvanceSalary::where('month', $month)->where('employee_id', $employee_id)->first();

        if ($advance === NULL) {

            AdvanceSalary::insert([
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Advance Salary Paid Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Advance Already Paid',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }
    }
}
