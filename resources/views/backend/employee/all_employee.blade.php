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
            <a href="" class="btn btn-success rounded-pill waves-effect waves-light">
              <i class="i-Edit text-25 text-success"></i>Add Employee</a>
          </div>
          <h4 class="page-title">All Employee</h4>
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
                @foreach ( $employee as $key=>$item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td><img src="{{asset($item->image)}}" style="width:50px; height:40px;"></td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->email}}</td>
                  <td>{{$item->phone}}</td>
                  <td>{{$item->salary}}</td>
                  <td>

                    <a href="" class="btn btn-blue rounded-pill waves-effect waves-light">
                      <i class="i-Edit text-25 text-success"></i>Edit</a>
                    <a href="" class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>

                  </td>
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