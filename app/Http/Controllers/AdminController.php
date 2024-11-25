<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'info',
        );

        return redirect('/login')->with($notification);
    } //end AdminDestroy(), Method

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    } //end AdminProfile(), Method

    public function AdminProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path(path: 'upload/admin_image'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } //end AdminProfileStore(), Method

    public function ChangePassword()
    {
        return view('admin.change_password');
    }

    public function UpdatePassword(Request $request)
    {

        /// Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',

        ]);

        /// Match The Old Password 
        if (!Hash::check($request->old_password, Auth::user()->password)) {

            $notification = [
                'message' => 'Old Password does not match!!',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }

        //// Update The New Password 

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    } // End Method 
}
