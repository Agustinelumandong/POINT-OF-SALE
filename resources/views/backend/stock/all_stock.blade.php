@extends('admin_dashboard')
@section('admin')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('export.product') }}" class="btn btn-danger rounded-pill waves-effect waves-light">
                                <i class="i-Edit text-25 text-success"></i>Export Product</a>
                            <a href="{{ route('import.product') }}" class="btn btn-warning rounded-pill waves-effect waves-light">
                                <i class="i-Edit text-25 text-success"></i>Import Product</a>
                            <a href="{{ route('add.product') }}" class="btn btn-success rounded-pill waves-effect waves-light">
                                <i class="i-Edit text-25 text-success"></i>Add Product</a>
                        </ol>
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
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th>Code</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key=> $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td> <img src="{{ asset($item->productImage) }}" style="width:50px; height: 40px;"> </td>
                                    <td>{{ $item->productName }}</td>
                                    <td>{{$item->productCategory->productCategoryName ?? 'N/A' }}</td>
                                    <td>{{ $item->supplier->supplierName ?? 'N/A' }}</td>
                                    <td>{{ $item->productCode }}</td>
                                    <td> <button class="btn btn-warning waves-effect waves-light">{{ $item->productStock }}</button> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- container -->
</div> <!-- content -->


@endsection