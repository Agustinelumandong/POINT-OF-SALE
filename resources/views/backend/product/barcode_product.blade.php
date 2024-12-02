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
          <a href="{{ route('all.product') }}" class="btn btn-success rounded-pill waves-effect waves-light">
            <i class="i-Edit text-25 text-success"></i>Back</a>
        </div>
        <h4 class="page-title">Barcode Product</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <!-- Start Content-->
  <div class="row card user-profile o-hidden mb-30">
    <div class="card-body">



      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div class="form-group mb-2">
            <label class="col-form-label pt-0" for="productName">Product Code *</label>
            <h3 class="">{{ $product->productCode }}</h3>
          </div>
        </div>
        @php
        $generateBarcode = new Picqer\Barcode\BarcodeGeneratorHTML();
        @endphp
        <div class="col-sm-12 col-md-6">
          <div class="form-group mb-2">
            <label class="col-form-label pt-0" for="productName">Product Barcode *</label>
            <h3 class="">{!! $generateBarcode->getBarcode($product->productCode, $generateBarcode::TYPE_CODE_128) !!}</h3>
          </div>
        </div>
      </div>
      <!-- End Content-->

    </div>
    <!-- End Container -->

  </div>



  @endsection