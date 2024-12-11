<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use App\Models\PaySalary;
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

    public function AllAdvanceSalary()
    {
        $advance = AdvanceSalary::latest()->get();
        return view('backend.salary.all_advance_salary', compact('advance'));
    }

    public function EditAdvanceSalary($id)
    {
        $advance = AdvanceSalary::findOrFail($id);
        $employee = Employee::latest()->get();
        return view('backend.salary.edit_advance_salary', compact('advance', 'employee'));
    }

    public function AdvanceSalaryUpdate(Request $request)
    {
        $advance = $request->id;


        AdvanceSalary::findOrFail($advance)->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'advance_salary' => $request->advance_salary,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Advance Salary Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.advance.salary')->with($notification);
    }

    public function DeleteAdvanceSalary($id)
    {
        // Find the customer record
        $advance = AdvanceSalary::findOrFail($id);

        // Soft delete the customer record
        $advance->delete();  // This will set the deleted_at timestamp

        $notification = [
            'message' => 'Advance Salary Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } //end method AdvanceSalary


    public function DeleteAdvanceSalary1($id)
    {
        // Find the advance salary record
        $advance = AdvanceSalary::findOrFail($id);

        // Find the employee associated with the advance salary
        $employee = Employee::findOrFail($advance->employee_id); // Assuming 'employee_id' is the foreign key in AdvanceSalary

        // Get the image path
        $img = public_path($employee->employeeImage);

        // Move the image to the deleted pictures folder
        $deletedImgDir = public_path('upload/deleted_advanceSalary');
        if (!file_exists($deletedImgDir)) {
            mkdir($deletedImgDir, 0755, true);
        }

        // Check if the image exists and move it
        if (file_exists($img)) {
            $deletedImgPath = $deletedImgDir . '/' . basename($img);
            rename($img, $deletedImgPath);
        }

        // Soft delete the advance salary record
        $advance->delete();  // This will set the deleted_at timestamp

        $notification = [
            'message' => 'Advance Salary Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } //end method DeleteAdvanceSalary

    public function ShowDeletedAdvanceSalary()
    {
        $deletedAdvanceSalary = AdvanceSalary::onlyTrashed()->latest()->get();
        return view("backend.salary.show_deleted_advance_salary", compact("deletedAdvanceSalary"));
    } //end method ShowDeletedEmployee


    public function RestoreAdvanceSalary($id)
    {
        $advance = AdvanceSalary::withTrashed()->findOrFail($id);
        $advance->restore();

        $notification = [
            'message' => 'Advance Salary Restored Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.advance.salary')->with($notification);
    } //end method RestoreEmployee



    //< --------------------------------- Pay Salary All Mehtod --------------------------------->


    public function PaySalary()
    {

        $employee = Employee::latest()->get();
        return view('backend.salary.pay_salary', compact('employee'));
    } // End Method 

    public function PayNowSalary($id)
    {

        $paySalary = Employee::findOrFail($id);
        return view('backend.salary.paid_salary', compact('paySalary'));
    } // End Method 

    public function EmployeeSalaryStore(Request $request)
    {

        $employee_id = $request->id;

        PaySalary::insert([

            'employee_id' => $employee_id,
            'monthlySalary' => $request->monthlySalary,
            'paidSalary' => $request->paidSalary,
            'dueSalary' => $request->dueSalary,
            'advanceSalary' => $request->advanceSalary,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Employee Salary Paid Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pay.salary')->with($notification);
    } // End Method 

    public function MonthSalary()
    {

        $paidSalary = PaySalary::latest()->get();
        return view('backend.salary.month_salary', compact('paidSalary'));
    } // End Method 


} // End Class
