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
            <a href="{{ route('add.product') }}" class="btn btn-success rounded-pill waves-effect waves-light">
              <i class="i-Edit text-25 text-success"></i>Add Product</a>
          </div>
          <h4 class="page-title">All Product</h4>
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
                  <th>ProductID</th>
                  <th>Product Image</th>
                  <th>Product Name</th>
                  <th>Product Category</th>
                  <th>Product Supplier</th>
                  <th>Product Code</th>
                  <th>Product Price</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ( $product as $key=>$item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td><img src="{{asset($item->productImage)}}" style="width:50px; height:40px;"></td>
                  <td>{{$item->productName}}</td>
                  <td>{{ $item['productCategory']['productCategoryName'] ?? 'N/A' }}</td>
                  <td>{{ $item['productSupplier']['supplierName'] ?? 'N/A' }}</td>
                  <td>{{$item->productCode}}</td>
                  <td>{{$item->sellingPrice}}</td>
                  <td>

                    <a href="{{ route('edit.product', $item->id)}}" class="btn btn-blue rounded-pill waves-effect waves-light "><i class="mdi mdi-square-edit-outline"></i>Edit</a>
                    <a href="{{ route('barcode.product', $item->id)}}" class="btn btn-info rounded-pill waves-effect waves-light "><i class="mdi mdi-square-edit-outline"></i>Code</a>
                    <a href="{{ route('delete.product', $item->id)}}" id="delete" name="delete" class="btn btn-danger rounded-pill waves-effect waves-light "><i class="mdi mdi-delete"> </i>Delete</a>

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