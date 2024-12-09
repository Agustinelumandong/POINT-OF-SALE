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
                                        <label for="firstname" class="form-label">Payment Method </label>
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



                            <!-- Modal content -->
                            <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <header class="modal-header">
                                            <h5 class="modal-title">Pay Due</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                                        </header>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mt-4">
                                                    <p><strong>Order Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp; {{ $order->orderDate }}</span></p>
                                                    <p><strong>Order Status : </strong> <span class="float-end"><span class="badge bg-danger">Unpaid</span></span></p>
                                                    <p><strong>Invoice No. : </strong> <span class="float-end">{{ $order->invoice_no }} </span></p>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="list-group">
                                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                    Payment Method
                                                                    <span class="font-weight-bold"> {{ $order->payment_status }}</span>
                                                                </div>
                                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                    Paid Amount
                                                                    <span class="font-weight-bold">$ {{ $order->pay }}</span>
                                                                </div>
                                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                    Due Amount
                                                                    <span class="font-weight-bold">$ {{ $order->due }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="complete-order-form" method="post" action="{{ route('order.status.update') }}" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <fieldset class="form-group">
                                                            <legend class="col-form-label pt-0">Payment</legend>
                                                            <select name="payment_status" class="form-select" id="payment_status" name="payment_status">
                                                                <option selected disabled>Select Payment</option>
                                                                <option value="Cash">Cash</option>
                                                                <option value="Gcash">Gcash</option>
                                                            </select>
                                                            <div class="invalid-feedback"></div>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <legend class="col-form-label pt-0">Received Amount *</legend>
                                                            <input type="text" placeholder="Received Amount" class="form-control" id="pay" name="pay">
                                                            <div class="invalid-feedback"></div>
                                                        </fieldset>
                                                        <div>
                                                            <label>Change Return:</label>
                                                            <p class="change_amount">0.00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" value="{{ $order->id }}">
                                                <input type="hidden" name="orderStatus" value="Pending">
                                                <input type="hidden" name="due" value="{{ $order->due }}">

                                                <div class="mb-3 text-center">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Complete Order </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->






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
                            <div class="text-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signup-modal">Pay Due</button>
                            </div>
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const payInput = document.getElementById('pay');
        const changeAmount = document.querySelector('.change_amount');
        const dueAmount = document.querySelector('input[name="due"]').value;
        const paymentSelect = document.getElementById('payment_status');
        const form = document.getElementById('complete-order-form');

        // Allow only numbers and decimal point
        payInput.addEventListener('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!(/[0-9.]/.test(char)) ||
                (char === '.' && this.value.includes('.'))) {
                e.preventDefault();
            }
        });

        payInput.addEventListener('input', function() {
            // Convert the input value to a float, default to 0 if NaN
            const receivedAmount = parseFloat(this.value) || 0;
            // Convert due amount to float
            const dueValue = parseFloat(dueAmount) || 0;
            // Calculate change
            const change = receivedAmount - dueValue;

            if (change >= 0) {
                changeAmount.textContent = change.toFixed(2);
                changeAmount.style.color = 'green';
            } else {
                changeAmount.textContent = '0.00';
                changeAmount.style.color = 'red';
            }
        });

        // Form validation before submit
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent form from submitting by default

            // Reset previous error states
            resetErrors();

            let isValid = true;

            // Validate payment method
            if (paymentSelect.value === 'Select Payment' || !paymentSelect.value) {
                showError(paymentSelect, 'Please select a payment method');
                isValid = false;
            }

            // Validate payment amount
            const receivedAmount = parseFloat(payInput.value) || 0;
            const dueValue = parseFloat(dueAmount) || 0;

            if (!payInput.value) {
                showError(payInput, 'Please enter the received amount');
                isValid = false;
            } else if (receivedAmount < dueValue) {
                showError(payInput, 'Received amount must be equal to or greater than the due amount');
                isValid = false;
            }

            // If all validations pass, submit the form
            if (isValid) {
                // Show confirmation dialog (optional)
                // You can add a confirmation dialog here if needed
                this.submit();
            }
        });

        // Helper function to show error
        function showError(element, message) {
            element.classList.add('is-invalid');
            const feedback = element.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.textContent = message;
                feedback.style.display = 'block';
            }
        }

        // Helper function to reset errors
        function resetErrors() {
            const invalidInputs = form.querySelectorAll('.is-invalid');
            invalidInputs.forEach(input => {
                input.classList.remove('is-invalid');
                const feedback = input.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.textContent = '';
                    feedback.style.display = 'none';
                }
            });
        }
    });
</script>

<script>
    document.getElementById('complete-order-form').addEventListener('submit', function(e) {
        // Submit the form using POST
        this.submit();
    });
</script>


@endsection