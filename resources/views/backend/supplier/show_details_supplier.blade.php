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
        <h4 class="page-title">Details Supplier</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <!-- Start Content-->
  <div class="row card user-profile o-hidden mb-30">
    <div class="card-body">
      <form method="post" action="{{ route('update.supplier') }}" enctype="multipart/form-data">
        @csrf

        <!-- Hidden input field to store the supplier's ID -->
        <input type="hidden" name="id" value="{{ $supplier->id }}">

        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="col-form-label pt-0" for="supplierName">Customer Name *</label>
              <p id="supplierName" class="text-black fw-bold fs-4">{{ $supplier->supplierName }}</p>
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" for="supplierEmail">Supplier Email *</label>
              <p id="supplierEmail" class="text-black fw-bold fs-4">{{ $supplier->supplierEmail }}</p>
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="supplierPhone">Supplier Phone *</label>
              <p id="supplierPhone" class="text-black fw-bold fs-4">{{ $supplier->supplierPhone }}</p>
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="supplierAddress">Supplier Address *</label>
              <p id="supplierAddress" class="text-black fw-bold fs-4">{{ $supplier->supplierAddress }}</p>
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="supplierType">Supplier Type *</label>
              <p id="supplierType" class="text-black fw-bold fs-4">{{ $supplier->supplierType }}</p>
            </div>
          </div>

        </div>
      </form>
    </div>
    <!-- End Content-->

  </div>
  <!-- End Container -->

</div>

@endsection