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
            <a href="{{ route('export.product') }}" class="btn btn-danger rounded-pill waves-effect waves-light">
              <i class="i-Edit text-25 text-success"></i>Export Product</a>
            <a href="{{ route('import.product') }}" class="btn btn-warning rounded-pill waves-effect waves-light">
              <i class="i-Edit text-25 text-success"></i>Import Product</a>
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
                  <th>Product Code</th>
                  <th>Product Image</th>
                  <th>Product Name</th>
                  <th>Product Category</th>
                  <th>Product Supplier</th>
                  <th>Product Stock</th>
                  <th>Product Price</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ( $product as $key=>$item)
                <tr>
                  <td>{{$item->productCode}}</td>
                  <!-- <td>$key+1 </td> -->
                  <td><img src="{{asset($item->productImage)}}" style="width:50px; height:40px;"></td>
                  <td>{{$item->productName}}</td>
                  <td>{{ $item->productCategory->productCategoryName ?? 'N/A' }}</td>
                  <td>{{ $item->supplier->supplierName ?? 'N/A' }}</td>
                  <td>{{$item->productStock}}</td>
                  <td>{{$item->sellingPrice}}</td>
                  <td>

                    <a href="{{ route('edit.product', $item->id)}}"><i class="fa-regular fa-pen-to-square fa-2xl"></i></a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('barcode.product', $item->id)}}"><i class="fa-solid fa-barcode fa-2xl" style="color: #74C0FC;"></i></a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('delete.product', $item->id)}}" id="delete" name="delete"><i class="fa-solid fa-trash-can fa-2xl" style="color: #ff0000;"></i></a>&nbsp;&nbsp;&nbsp;

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