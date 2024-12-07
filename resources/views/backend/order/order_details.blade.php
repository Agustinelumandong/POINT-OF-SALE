@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                    <h4 class="page-title">Order Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- end timeline content-->
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{route('order.status.update')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $order->id }}">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Name</label>
                                            <p class="text-danger"> {{ $order->customer->customerName }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Email</label>
                                            <p class="text-danger"> {{ $order->customer->customerEmail }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Phone</label>
                                            <p class="text-danger"> {{ $order->customer->customerPhone }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Order Date </label>
                                            <p class="text-danger"> {{ $order->orderDate }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Order Invoice </label>
                                            <p class="text-danger"> {{ $order->invoice_no }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Payment Status </label>
                                            <p class="text-danger"> {{ $order->payment_status }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Paid Amount </label>
                                            <p class="text-danger"> {{ $order->pay }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Due Amount </label>
                                            <p class="text-danger"> {{ $order->due }} </p>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Complete Order </button>
                                </div>
                            </form>
                        </div>
                        <!-- end settings content-->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total(+vat)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orderItem as $item)
                                            <tr>
                                                <td> <img src="{{ asset($item->product->productImage)}}" style="width:50px; height: 40px;"> </td>
                                                <td>{{ $item->product->productName}}</td>
                                                <td>{{ $item->product->productCode}}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->product->sellingPrice}}</td>
                                                <td>{{ $item->totalCost}}</td>
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
                </div>
                <!-- end card-->
            </div>
            <!-- end col -->
        </div>
        <!-- end row-->
    </div>
    <!-- container -->
</div>
<!-- content -->


@endsection