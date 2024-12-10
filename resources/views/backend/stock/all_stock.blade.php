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
                                <a href="{{ route('export.product') }}"
                                    class="btn btn-danger rounded-pill waves-effect waves-light">
                                    <i class="i-Edit text-25 text-success"></i>Export Product</a>
                                <a href="{{ route('import.product') }}"
                                    class="btn btn-warning rounded-pill waves-effect waves-light">
                                    <i class="i-Edit text-25 text-success"></i>Import Product</a>
                                <a href="{{ route('add.product') }}"
                                    class="btn btn-success rounded-pill waves-effect waves-light">
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> <img src="{{ asset($item->productImage) }}"
                                                    style="width:50px; height: 40px;"> </td>
                                            <td>{{ $item->productName }}</td>
                                            <td>{{ $item->productCategory->productCategoryName ?? 'N/A' }}</td>
                                            <td>{{ $item->supplier->supplierName ?? 'N/A' }}</td>
                                            <td>{{ $item->productCode }}</td>
                                            <td> <button class="btn btn-warning waves-effect waves-light"
                                                    disabled>{{ $item->productStock }}</button>
                                            </td>
                                            <td> <button class="btn btn-warning waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#signup-modal"
                                                    onclick="productStock(this.id)" id="{{ $item->id }}"><i
                                                        class="fa fa-pen-alt"></i></button>
                                            </td>
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

    <!-- Modal content -->
    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <header class="modal-header">
                    <h5 class="modal-title">Edit Product Stock</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fas fa-times"></i></button>
                </header>
                <div class="modal-body">
                    <div class="row">
                        <div>
                            <h4 class="text-center">Product Name: <span class="fw-5" id="productName"
                                    value="productName"></span></h4>
                        </div>
                    </div>
                    <form id="complete-order-form" method="post" action="{{ route('update.stock') }}">
                        @csrf

                        <input type="hidden" id="id" name="id">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <fieldset class="form-group">
                                    <legend class="col-form-label pt-0">Update Stock Amount *</legend>
                                    <input type="text" placeholder="Stock Amount" class="form-control" id="productStock"
                                        name="productStock">
                                    <div class="invalid-feedback"></div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-success waves-effect waves-light"> Update Stock</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->





    <script type="text/javascript">
        function productStock(id) {
            $.ajax({
                type: 'GET',
                url: '/product-stock/' + id,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#productStock').val(data.productStock);
                    $('#id').val(data.id);
                    $('#productName').text(data.productName);
                }
            });
        }
    </script>
@endsection
