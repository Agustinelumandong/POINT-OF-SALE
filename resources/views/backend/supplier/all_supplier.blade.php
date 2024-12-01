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
            <a href="{{ route('add.supplier') }}" class="btn btn-success rounded-pill waves-effect waves-light">
              <i class="i-Edit text-25 text-success"></i>Add Supplier</a>
          </div>
          <h4 class="page-title">All Supplier</h4>
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
                  <th>SupplierID</th>
                  <th>Supplier Name</th>
                  <th>Supplier Email</th>
                  <th>Supplier Phone</th>
                  <th>Supplier Type</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ( $supplier as $key=>$item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{$item->supplierName}}</td>
                  <td>{{$item->supplierEmail}}</td>
                  <td>{{$item->supplierPhone}}</td>
                  <td>{{$item->supplierType}}</td>
                  <td>

                    <a href="{{ route('edit.supplier', $item->id)}}" class="btn btn-blue rounded-pill waves-effect waves-light "><i class="mdi mdi-square-edit-outline"></i>Edit</a>
                    <a href="{{ route('delete.supplier', $item->id)}}" id="delete" name="delete" class="btn btn-danger rounded-pill waves-effect waves-light "><i class="mdi mdi-delete"> </i>Delete</a>
                    <a href="{{ route('details.supplier', $item->id)}}" class="btn btn-info rounded-pill waves-effect waves-light "><i class="mdi mdi-information-outline"></i>Details</a>
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