<?php

namespace App\Http\Controllers\Backend;

// Load Composer's autoloader
require '../vendor/autoload.php';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    // All Employee
    public function AllEmployee()
    {
        $employee = Employee::latest()->get();
        return view("backend.employee.all_employee", compact("employee"));
    } //end method AllEmployee

    public function AddEmployee()
    {
        return view("backend.employee.add_employee");
    } //end method AddEmployee

    public function StoreEmployee(Request $request)
    {
        $validateData = $request->validate([
            'employeeName' => 'required|max:255',
            'employeeEmail' => 'required|unique:employees|max:255',
            'employeePhone' => 'required|max:255',
            'employeeSalary' => 'required|max:255',
            'employeeVacation' => 'required|max:255',
            'employeeImage' => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($request->file('employeeImage')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('employeeImage')->getClientOriginalExtension();
            $img = $manager->read($request->file('employeeImage'));
            $img->resize(300, 300);

            $img->toJpeg(80)->save(base_path("public/upload/employee_image/{$name_gen}"));
            $save_url = "upload/employee_image/{$name_gen}";

            Employee::create([
                'employeeName' => $request->employeeName,
                'employeeEmail' => $request->employeeEmail,
                'employeePhone' => $request->employeePhone,
                'employeeSalary' => $request->employeeSalary,
                'employeeVacation' => $request->employeeVacation,
                'employeeImage' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        } //end if



        $notification = [
            'message' => 'Employee Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.employee')->with($notification);

        // $employee = Employee::create($request->all());
        // return redirect()->route('all.employee')->with('success', 'Employee Added Successfully');
    }

    public function EditEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        return view("backend.employee.edit_employee", compact("employee"));
    } //end method EditEmployee

    public function UpdateEmployee(Request $request)
    {
        $employee_id = $request->id;

        // Find the employee record
        $employee = Employee::findOrFail($employee_id);

        // Check if a new image is being uploaded
        if ($request->file('employeeImage')) {
            // Get the current image path
            $oldImagePath = public_path($employee->employeeImage);

            // Delete the old image if it exists
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Process the new image
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('employeeImage')->getClientOriginalExtension();
            $img = $manager->read($request->file('employeeImage'));
            $img->resize(300, 300);
            $img->toJpeg(80)->save(base_path("public/upload/employee_image/{$name_gen}"));
            $save_url = "upload/employee_image/{$name_gen}";

            // Update the employee record with the new image
            $employee->update([
                'employeeName' => $request->employeeName,
                'employeeEmail' => $request->employeeEmail,
                'employeePhone' => $request->employeePhone,
                'employeeSalary' => $request->employeeSalary,
                'employeeVacation' => $request->employeeVacation,
                'employeeImage' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        } else {
            // If no new image, just update other fields
            $employee->update([
                'employeeName' => $request->employeeName,
                'employeeEmail' => $request->employeeEmail,
                'employeePhone' => $request->employeePhone,
                'employeeSalary' => $request->employeeSalary,
                'employeeVacation' => $request->employeeVacation,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = [
            'message' => 'Employee Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.employee')->with($notification);
    } //end method UpdateEmployee

    // public function DeleteEmployee($id)
    // {
    //     // Find the employee record
    //     $employee = Employee::findOrFail($id);

    //     // Get the image path
    //     $img = $employee->employeeImage;

    //     // Move the image to the deleted pictures folder
    //     if (file_exists($img)) {
    //         $deletedImgPath = 'public/upload/deleted_employee/' . basename($img);
    //         rename($img, $deletedImgPath);
    //     }

    //     // Soft delete the employee record
    //     $employee->delete();  // This will set the deleted_at timestamp

    //     $notification = [
    //         'message' => 'Employee Deleted Successfully',
    //         'alert-type' => 'success',
    //     ];

    //     return redirect()->back()->with($notification);
    // } //end method DeleteEmployee

    public function DeleteEmployee($id)
    {
        // Find the employee record
        $employee = Employee::findOrFail($id);

        // Get the image path
        $img = public_path($employee->employeeImage);

        // Move the image to the deleted pictures folder
        $deletedImgDir = public_path('upload/deleted_employee');
        if (!file_exists($deletedImgDir)) {
            mkdir($deletedImgDir, 0755, true);
        }

        if (file_exists($img)) {
            $deletedImgPath = $deletedImgDir . '/' . basename($img);
            rename($img, $deletedImgPath);
        }

        // Soft delete the employee record
        $employee->delete();  // This will set the deleted_at timestamp

        $notification = [
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } //end method DeleteEmployee

    // public function ShowDeletedEmployee()
    // {
    //     $deletedEmployee = Employee::onlyTrashed()->latest()->get();
    //     foreach ($deletedEmployee as $employee) {
    //         $employee->deletedImagePath = base_path('public/upload/deleted_employee/' . basename($employee->employeeImage));
    //     }
    //     return view("backend.employee.show_deleted_employee", compact("deletedEmployee"));
    // } //end method ShowDeletedEmployee


    // public function ShowDeletedEmployee()
    // {
    //     $deletedEmployee = Employee::onlyTrashed()->latest()->get();
    //     foreach ($deletedEmployee as $employee) {
    //         $employee->deletedImagePath = public_path('upload/deleted_employee/' . basename($employee->employeeImage));
    //     }
    //     return view("backend.employee.show_deleted_employee", compact("deletedEmployee"));
    // } //end method ShowDeletedEmployee

    public function ShowDeletedEmployee()
    {
        $deletedEmployees = Employee::onlyTrashed()->latest()->get();
        foreach ($deletedEmployees as $employee) {
            // Construct the URL for the deleted image
            $employee->deletedImagePath = asset('upload/deleted_employee/' . basename($employee->employeeImage));
        }
        return view("backend.employee.show_deleted_employee", compact("deletedEmployees"));
    } //end method ShowDeletedEmployee


    public function RestoreEmployee($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->restore();

        // Define paths
        $deletedImgPath = public_path('upload/deleted_employee/' . basename($employee->employeeImage));
        $originalImgPath = public_path('upload/employee_image/' . basename($employee->employeeImage));

        // Check if the original directory exists, if not, create it
        $originalImgDir = public_path('upload/employee_image');
        if (!file_exists($originalImgDir)) {
            mkdir($originalImgDir, 0755, true);
        }

        // Move the image back to the original folder
        if (file_exists($deletedImgPath)) {
            rename($deletedImgPath, $originalImgPath);
        }

        $notification = [
            'message' => 'Employee Restored Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.employee')->with($notification);
    } //end method RestoreEmployee

    public function DeletePermanentlyEmployee($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $img = public_path('upload/deleted_employee/' . basename($employee->employeeImage));

        // Delete the image from the deleted folder if it exists
        if (file_exists($img)) {
            unlink($img);
        }

        // Permanently delete the employee record
        $employee->forceDelete();

        $notification = [
            'message' => 'Employee Permanently Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('show.deleted.employee')->with($notification);
    } //end method DeletePermanentlyEmployee

} //end class EmployeeController

 // public function ShowDeletedEmployee()
    // {
    //     $deletedEmployee = Employee::onlyTrashed()->latest()->get();
    //     return view("backend.employee.show_deleted_employee", compact("deletedEmployee"));
    // } //end method ShowDeletedEmployee
