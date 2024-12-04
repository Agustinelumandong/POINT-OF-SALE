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

          </div>
          <h4 class="page-title">Month Expense</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->
    @php
    $expenseMonth = date('F');
    $monthExpenseSum = App\Models\Expense::where('expenseMonth', $expenseMonth)->sum('expenseAmount');
    $monthExpenses = App\Models\Expense::where('expenseMonth', $expenseMonth)->get();
    @endphp
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body ">
            <div class="page-title-box ">
              <div class="page-title-right">
                <h4 class="header-title">Total Expense: <span class="text-success fs-1">₱{{ $monthExpenseSum }}</span></h4>
              </div>
              <h4 class="page-title">Month Expense</h4>
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
                </tr>
              </thead>
              @foreach ($monthExpenses as $key=>$item)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{$item->expenseDetails}}</td>
                <td class="text-danger fw-bolder">₱{{$item->expenseAmount}}</td>
                <td>{{$item->expenseMonth}}</td>
              </tr>

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