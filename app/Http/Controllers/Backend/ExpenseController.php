<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;


class ExpenseController extends Controller
{
    //
    public function AddExpense()
    {
        return view("backend.expense.add_expense");
    } //end method AddExpense

    public function StoreExpense(Request $request)
    {

        Expense::insert([

            'expenseDetails' => $request->expenseDetails,
            'expenseAmount' => $request->expenseAmount,
            'expenseMonth' => $request->expenseMonth,
            'expenseYear' => $request->expenseYear,
            'expenseDate' => $request->expenseDate,
            'created_at' => Carbon::now(),
        ]);


        $notification = [
            'message' => 'Expense Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    } //end method StoreExpense

    public function TodayExpense()
    {
        $date = date('d-m-y');
        $todayExpense = Expense::where('expenseDate', $date)->get();

        return view("backend.expense.today_expense", compact("todayExpense"));
    } //end method TodayExpense

    public function EditExpense($id)
    {
        $expense = Expense::findOrFail($id);
        return view("backend.expense.edit_expense", compact("expense"));
    } //end method EditExpense

    public function UpdateExpense(Request $request)
    {

        Expense::findOrFail($request->id)->update([
            'expenseDetails' => $request->expenseDetails,
            'expenseAmount' => $request->expenseAmount,
            'expenseMonth' => $request->expenseMonth,
            'expenseYear' => $request->expenseYear,
            'expenseDate' => $request->expenseDate,
        ]);

        $notification = [
            'message' => 'Expense Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('today.expense')->with($notification);
    } //end method UpdateExpense

    public function MonthExpense()
    {
        $month = date('F');
        $expenseMonth = Expense::where('expenseMonth', $month)->get();
        return view("backend.expense.month_expense", compact("expenseMonth"));
    } //end method MonthExpense

    public function YearExpense()
    {
        $year = date('Y');
        $expenseYear = Expense::where('expenseYear', $year)->get();
        return view("backend.expense.year_expense", compact("expenseYear"));
    } //end method YearExpense
}
