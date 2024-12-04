@extends ('admin_dashboard')
@section('admin')
<div class="content">
  <!-- Start Content-->
  <div class="container-fluid">
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <div class="page-title-right">
            <a href="{{ route('add.expense') }}" class="btn btn-success rounded-pill waves-effect waves-light">
              <i class="i-Edit text-25 text-success"></i>Add Expense</a>
          </div>
          <h4 class="page-title">Today Expense</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->
    @php
    $expenseDate = date('d-m-Y');
    $todayExpenseSum = App\Models\Expense::where('expenseDate', $expenseDate)->sum('expenseAmount');
    $todayExpenses = App\Models\Expense::where('expenseDate', $expenseDate)->get();
    @endphp
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body ">
            <div class="page-title-box ">
              <div class="page-title-right">
                <h4 class="header-title">Total Expense: <span class="text-success fs-1">₱{{ $todayExpenseSum }}</span></h4>
              </div>
              <h4 class="page-title">Today Expense</h4>
            </div>



            <table
              id="basic-datatable"
              class="table dt-responsive nowrap w-100">
              <thead>
                <tr>
                  <th>ExpenseID</th>
                  <th>Expense Details</th>
                  <th>Expense Amount</th>
                  <th>Expense Monthly</th>
                  <th>Expense Yearly</th>
                  <th>Action</th>
                </tr>
              </thead>
              @foreach ($todayExpenses as $key=>$item)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{$item->expenseDetails}}</td>
                <td class="text-danger fw-bolder">₱{{$item->expenseAmount}}</td>
                <td>{{$item->expenseMonth}}</td>
                <td>{{$item->expenseYear}}</td>
                <td>

                  <a href="{{ route('edit.expense', $item->id)}}"><i class="fa-regular fa-pen-to-square fa-2xl"></i></a>&nbsp;&nbsp;&nbsp;

                </td>

                @endforeach

                </tbody>
            </table>
          </div>
          <!-- end card body-->
        </div>
        <!-- end card -->
      </div>
      <!-- end col-->
    </div>
    <!-- end row-->
  </div>
  <!-- container -->
</div>
<!-- content -->
@endsection