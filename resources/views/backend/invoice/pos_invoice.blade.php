@extends('admin_dashboard')
@section('admin')
@php
use Gloudemans\Shoppingcart\Facades\Cart;
@endphp


<div class="content">

  <!-- Start Content-->
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <div class="page-title-right">

          </div>
          <h4 class="page-title">Customer Invoice</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-12">
        <div class="card">customers
          <div class="card-body">
            <!-- Logo & title -->
            <div class="clearfix">
              <div class="float-start">
                <div class="auth-logo">
                  <div class="logo logo-dark">
                    <span class="logo-lg">
                      <img src="{{ asset('backend/assets/images/pos-logo-2.png') }}" alt="" height="42">
                    </span>
                  </div>
                  <div class="logo logo-light">
                    <span class="logo-lg">
                      <img src="{{ asset('backend/assets/images/pos-logo-2.png') }}" alt="" height="42">
                    </span>
                  </div>
                </div>
              </div>
              <div class="float-end">
                <h4 class="m-0 d-print-none">Invoice</h4>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mt-3">
                  <p><b>Hello, {{ $customer->customerName }}</b></p>

                </div>

              </div><!-- end col -->
              <div class="col-md-4 offset-md-2">
                <div class="mt-3 float-end">
                  <p><strong>Order Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp; Jan 17, 2016</span></p>
                  <p><strong>Order Status : </strong> <span class="float-end"><span class="badge bg-danger">Unpaid</span></span></p>
                  <p><strong>Invoice No. : </strong> <span class="float-end">000028 </span></p>
                </div>
              </div><!-- end col -->
            </div>
            <!-- end row -->

            <div class="row mt-3">
              <div class="col-sm-6">
                <h6>Billing Address</h6>
                <address>
                  <abbr title="Address">Address:</abbr> {{ $customer->customerAddress }}<br>
                  <abbr title="Phone">Phone:</abbr> {{ $customer->customerPhone }}<br>
                  <abbr title="Email">Email:</abbr> {{ $customer->customerEmail }}<br>
                </address>
              </div> <!-- end col -->


            </div>
            <!-- end row -->
            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table class="table mt-4 table-centered">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Item</th>
                        <th style="width: 10%">Qty</th>
                        <th style="width: 10%">Unit Cost</th>
                        <th style="width: 10%" class="text-end">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $sl = 1;
                      @endphp

                      @foreach($content as $key=> $item)
                      <tr>
                        <td>{{ $sl++ }}</td>
                        <td>
                          <b><span>{{$item->name}}</span> <br> <span class="badge bg-success">{{$item->id}}</span></b>
                        </td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->price }}</td>
                        <td class="text-end">${{ $item->price*$item->qty }}</td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div> <!-- end table-responsive -->
              </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
              <div class="col-sm-6">
                <div class="clearfix pt-5">
                  <h6 class="text-muted">Notes:</h6>
                  <p>
                    Thank you for buying from us. If you have any questions about this invoice, please contact us at support@example.com. We appreciate your business and hope to serve you again in the future. Please keep this invoice for your records.
                  </p>
                </div>
              </div> <!-- end col -->
              <div class="col-sm-6">
                <div class="float-end">
                  <p><b>Sub-total:</b> <span class="float-end">₱{{ Cart::subtotal() }}</span></p>
                  <p><b>Vat (21%):</b> <span class="float-end"> &nbsp;&nbsp;&nbsp; ₱{{ Cart::tax() }}</span></p>
                  <h3>₱{{ Cart::total() }} PHP</h3>
                </div>
                <div class="clearfix"></div>
              </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="mt-4 mb-1">
              <div class="text-end d-print-none">
                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer me-1"></i> Print</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal">Done</button>
              </div>
            </div>
          </div>
        </div> <!-- end card -->
      </div> <!-- end col -->
    </div>
    <!-- end row -->
  </div> <!-- container -->
</div> <!-- content -->


<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <header class="modal-header">
      <h5 class="modal-title">Create Payment</h5>
      <button type="button" class="close" aria-label="Close">×</button>
    </header>
    <div class="modal-body">
      <form>
        <div class="row">
          <div class="col-md-6">
            <fieldset class="form-group">
              <legend class="col-form-label pt-0">Received Amount *</legend>
              <input type="text" placeholder="Received Amount" class="form-control" id="received_amount">
              <div class="invalid-feedback"></div>
            </fieldset>
            <fieldset class="form-group">
              <legend class="col-form-label pt-0">Paying Amount *</legend>
              <input type="text" placeholder="Paying Amount" class="form-control" id="paying_amount">
              <div class="invalid-feedback"></div>
            </fieldset>
            <div>
              <label>Change Return:</label>
              <p class="change_amount">0.00</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="list-group">
                  <div class="list-group-item d-flex justify-content-between align-items-center">
                    Total Products
                    <span class="badge badge-primary badge-pill">1</span>
                  </div>
                  <div class="list-group-item d-flex justify-content-between align-items-center">
                    Order Tax
                    <span class="font-weight-bold">$ 0.00 (0 %)</span>
                  </div>
                  <div class="list-group-item d-flex justify-content-between align-items-center">
                    Discount
                    <span class="font-weight-bold">$ 0.00</span>
                  </div>
                  <div class="list-group-item d-flex justify-content-between align-items-center">
                    Shipping
                    <span class="font-weight-bold">$ 0.00</span>
                  </div>
                  <div class="list-group-item d-flex justify-content-between align-items-center">
                    Total Payable
                    <span class="font-weight-bold">$ 34.00</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-6">
            <fieldset class="form-group">
              <legend class="col-form-label pt-0">Payment choice *</legend>
              <select class="form-control">
                <option>Cash</option>
                <!-- Add other payment options here -->
              </select>
              <div class="invalid-feedback"></div>
            </fieldset>
          </div>
          <div class="col-md-6">
            <fieldset class="form-group">
              <legend class="col-form-label pt-0">Account</legend>
              <select class="form-control">
                <option>Choose Account</option>
                <!-- Add account options here -->
              </select>
              <div class="invalid-feedback"></div>
            </fieldset>
          </div>
          <div class="col-md-12">
            <fieldset class="form-group">
              <legend class="col-form-label pt-0">Payment notes</legend>
              <textarea class="form-control" style="resize: none; height: 73px;"></textarea>
            </fieldset>
          </div>
          <div class="col-md-12">
            <fieldset class="form-group">
              <legend class="col-form-label pt-0">Sale notes</legend>
              <textarea class="form-control" style="resize: none; height: 73px;"></textarea>
            </fieldset>
          </div>
          <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">
              <i class="i-Yes me-2 font-weight-bold"></i> Submit
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal content -->
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <header class="modal-header">
        <h5 class="modal-title">Create Payment</h5>

        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </header>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <fieldset class="form-group">
              <legend class="col-form-label pt-0">Payment</legend>
              <select name="payment_status" class="form-select" id="payment_status">
                <option selected disabled>Select Payment</option>
                <option value="HandCash">HandCash</option>
                <option value="Cheque">Cheque</option>
                <option value="Due">Due</option>
              </select>
              <div class="invalid-feedback"></div>
            </fieldset>
            <fieldset class="form-group">
              <legend class="col-form-label pt-0">Received Amount *</legend>
              <input type="text" placeholder="Received Amount" class="form-control" id="received_amount">
              <div class="invalid-feedback"></div>
            </fieldset>
            <fieldset class="form-group">
              <legend class="col-form-label pt-0">Paying Amount *</legend>
              <input type="text" placeholder="Paying Amount" class="form-control" id="paying_amount">
              <div class="invalid-feedback"></div>
            </fieldset>
            <div>
              <label>Change Return:</label>
              <p class="change_amount">0.00</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="list-group">
                  <div class="list-group-item d-flex justify-content-between align-items-center">
                    Total Products
                    <span class="badge badge-primary badge-pill">{{ Cart::count() }}</span>
                  </div>
                  <div class="list-group-item d-flex justify-content-between align-items-center">
                    Order Tax
                    <span class="font-weight-bold">$ {{ Cart::tax() }} (21%)</span>
                  </div>
                  <div class="list-group-item d-flex justify-content-between align-items-center">
                    Discount
                    <span class="font-weight-bold">$ 0.00</span>
                  </div>
                  <div class="list-group-item d-flex justify-content-between align-items-center">
                    Shipping
                    <span class="font-weight-bold">$ 0.00</span>
                  </div>
                  <div class="list-group-item d-flex justify-content-between align-items-center">
                    Total Payable
                    <span class="font-weight-bold">$ {{ Cart::total() }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <form method="post" action="{{ url('/final-invoice') }}">
          @csrf
          <input type="hidden" name="customer_id" value="{{ $customer->id }}">
          <input type="hidden" name="order_date" value="{{ date('d-F-Y') }}">
          <input type="hidden" name="order_status" value="pending">
          <input type="hidden" name="total_products" value="{{ Cart::count() }}">
          <input type="hidden" name="sub_total" value="{{ Cart::subtotal() }}">
          <input type="hidden" name="vat" value="{{ Cart::tax() }}">
          <input type="hidden" name="total" value="{{ Cart::total() }}">
          <div class="mb-3 text-center">
            <button class="btn btn-primary" type="submit">Complete Order</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->






@endsection