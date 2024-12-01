@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<!-- Start Container-->
<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">

        </div>
        <h4 class="page-title">Update Customers</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <!-- Start Content-->
  <div class="row card user-profile o-hidden mb-30">
    <div class="card-body">
      <form method="post" action="{{ route('update.customer') }}" enctype="multipart/form-data">
        @csrf


        <!-- Hidden input field to store the customer's ID -->
        <input type="hidden" name="id" value="{{ $customer->id }}">


        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="col-form-label pt-0" for="customerName">Customer Name *</label>
              <input id="customerName" name="customerName" type="text" class="form-control @error('customerName') is-invalid @enderror" value="{{ $customer->customerName }}">
              @error('customerName')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" for="customerEmail">Customers Email *</label>
              <input id="customerEmail" name="customerEmail" type="text" class="form-control @error('customerEmail') is-invalid @enderror" value="{{ $customer->customerEmail }}">
              @error('customerEmail')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="customerPhone">Customers Phone *</label>
              <input id="customerPhone" name="customerPhone" type="text" class="form-control @error('customerPhone') is-invalid @enderror" value="{{ $customer->customerPhone }}">
              @error('customerPhone')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="customerAddress">Customers Address *</label>
              <input id="customerAddress" name="customerAddress" type="text" class="form-control @error('customerAddress') is-invalid @enderror" value="{{ $customer->customerAddress }}">
              @error('customerAddress')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>


          <div class="text-end">
            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
          </div>

        </div>
      </form>
    </div>
    <!-- End Content-->

  </div>
  <!-- End Container -->

</div>

@endsection