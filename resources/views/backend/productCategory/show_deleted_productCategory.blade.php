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
          <h4 class="page-title">All Deleted Product Category</h4>
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
                  <th>Product Category ID</th>
                  <th>Product Category Name</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ( $deletedProductCategory as $key=>$item)
                <tr>

                  <td>{{ $key+1 }}</td>
                  <td>{{$item->productCategoryName}}</td>
                  <td>

                    <a href="{{ route('restore.productCategory', $item->id)}}"><i class="fa-solid fa-arrow-rotate-left fa-2xl" style="color: #74C0FC;"></i></a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('delete.permanently.productCategory', $item->id)}}" id="delete" name="delete"><i class="fa-solid fa-trash-can fa-2xl" style="color: #ff0000;"></i></a>&nbsp;&nbsp;&nbsp;

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