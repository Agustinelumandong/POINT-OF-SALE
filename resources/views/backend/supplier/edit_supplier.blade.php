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
        <h4 class="page-title">Update Supplier</h4>
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
              <input id="supplierName" name="supplierName" type="text" class="form-control @error('supplierName') is-invalid @enderror" value="{{ $supplier->supplierName }}">
              @error('supplierName')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" for="supplierEmail">Supplier Email *</label>
              <input id="supplierEmail" name="supplierEmail" type="text" class="form-control @error('supplierEmail') is-invalid @enderror" value="{{ $supplier->supplierEmail }}">
              @error('supplierEmail')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="supplierPhone">Supplier Phone *</label>
              <input id="supplierPhone" name="supplierPhone" type="text" class="form-control @error('supplierPhone') is-invalid @enderror" value="{{ $supplier->supplierPhone }}">
              @error('supplierPhone')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="supplierAddress">Supplier Address *</label>
              <input id="supplierAddress" name="supplierAddress" type="text" class="form-control @error('supplierAddress') is-invalid @enderror" value="{{ $supplier->supplierAddress }}">
              @error('supplierAddress')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="supplierType">Supplier Type *</label>
              <select name="supplierType" id="supplierType" class="form-select @error('supplierType') is-invalid @enderror">
                <option selected disabled>Select Supplier Type</option>
                <option value="Distributor" {{ $supplier->supplierType == 'Distributor' ? 'selected' : '' }}>Distributor</option>
                <option value="Whole Seller" {{ $supplier->supplierType == 'Whole Seller' ? 'selected' : '' }}>Whole Seller</option>
              </select>
              @error('supplierType')
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