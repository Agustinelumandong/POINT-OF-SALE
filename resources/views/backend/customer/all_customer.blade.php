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
            <a href="{{ route('add.customer') }}" class="btn btn-success rounded-pill waves-effect waves-light">
              <i class="i-Edit text-25 text-success"></i>Add Customer</a>
          </div>
          <h4 class="page-title">All Customer</h4>
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
                  <th>CustomerID</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Customer Phone</th>
                  <th>Customer Address</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ( $customer as $key=>$item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{$item->customerName}}</td>
                  <td>{{$item->customerEmail}}</td>
                  <td>{{$item->customerPhone}}</td>
                  <td>{{$item->customerAddress}}</td>
                  <td>




                    <a href="{{ route('edit.customer', $item->id)}}"><i class="fa-regular fa-pen-to-square fa-2xl"></i></a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('delete.customer', $item->id)}}" id="delete" name="delete"> <i class="fa-solid fa-trash-can fa-2xl" style="color: #ff0000;"></i></a>&nbsp;&nbsp;&nbsp;
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