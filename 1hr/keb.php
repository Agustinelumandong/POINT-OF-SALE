// employess route
Route::resource('employees', EmployeesController::class);
Route::get('employee/personal-info/{employeeDetail}', [EmployeeDetailsController::class, 'personalInfo'])->name('employee.personal-info');
Route::post('employee/personal-info/{employeeDetail}', [EmployeeDetailsController::class, 'updatePersonalInfo']);
Route::get('employees-list', [EmployeesController::class, 'list'])->name('employees.list');
Route::resource('holidays', HolidaysController::class);
Route::get('holidays-calendar', [HolidaysController::class, 'calendar'])->name('holidays.calendar');
Route::get('attendance', [AttendancesController::class, 'index'])->name('attendances.index');
Route::get('attendance-details/{attendance}', [AttendancesController::class, 'attendanceDetails'])->name('attendance.details');

Route::group(['prefix' => 'payroll'], function () {
Route::get('items', [PayrollsController::class, 'items'])->name('payroll.items');
Route::resource('allowances', AllowancesController::class)->except(['show']);
Route::resource('deductions', DeductionsController::class)->except(['show']);
Route::resource('payslips', PayrollsController::class);
});