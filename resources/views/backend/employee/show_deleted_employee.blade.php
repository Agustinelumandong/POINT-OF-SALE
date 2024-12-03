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
          <h4 class="page-title">All Deleted Employee</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">

            <table
              id="basic-datatable"
              class="table dt-responsive nowrap w-100">
              <thead>
                <tr>
                  <th>EmployeeID</th>
                  <th>Employee Image</th>
                  <th>Employee Name</th>
                  <th>Employee Email</th>
                  <th>Employee Phone</th>
                  <th>Employee Salary</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ( $deletedEmployees as $key=>$item)
                <tr>

                  <td>{{ $key+1 }}</td>
                  <!-- <td><img src="{{asset($item->employeeImage)}}" style="width:45px; height:40px;"></td> -->
                  <td><img src="{{ $item->deletedImagePath }}" alt="Deleted Employee Image" style="width: 45px; height: 40;"></td>
                  <td>{{$item->employeeName}}</td>
                  <td>{{$item->employeeEmail}}</td>
                  <td>{{$item->employeePhone}}</td>
                  <td>{{$item->employeeSalary}}</td>
                  <td>



                    <a href="{{ route('restore.employee', $item->id)}}"><i class="fa-solid fa-arrow-rotate-left fa-2xl" style="color: #74C0FC;"></i></a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('delete.permanently.employee', $item->id)}}" id="delete" name="delete"><i class="fa-solid fa-trash-can fa-2xl" style="color: #ff0000;"></i></a>&nbsp;&nbsp;&nbsp;
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