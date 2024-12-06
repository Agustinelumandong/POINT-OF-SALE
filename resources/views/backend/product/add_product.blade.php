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
        <h4 class="page-title">Add Product</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <!-- Start Content-->
  <div class="row card user-profile o-hidden mb-30">
    <div class="card-body">
      <form id="myForm" method="post" action="{{ route('store.product') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="col-form-label pt-0" for="productName">Product Name *</label>
              <input id="productName" name="productName" type="text" class="form-control">
            </div>
          </div>



          <!-- <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="col-form-label pt-0" for="productCode">Product Code *</label>
              <div class="input-group">
                <div class="input-group-prepend"></div>
                <input type="text" class="form-control " id="productCode">
                <div class="input-group-append">
                  <span class="input-group-text ">
                    <a class="btn btn-link p-0 m-0">
                      <i class="fa-solid fa-qrcode"></i>
                    </a>
                  </span>
                </div>
              </div>
            </div>
          </div> -->


          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" for="productSupplier">Product Supplier *</label>
              <select name="supplierID" id="productSupplier" class="form-select">
                <option selected disabled>Select Supplier</option>
                @foreach ($productSupplier as $supplier)
                <option value=" {{ $supplier->id}}">{{ $supplier->supplierName}}</option>
                @endforeach
              </select>

            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" for="productCategory">Product Category *</label>
              <select name="categoryID" id="productCategory" class="form-select ">
                <option selected disabled>Select Category</option>
                @foreach ($productCategory as $category)
                <option value=" {{ $category->id}}">{{ $category->productCategoryName}}</option>
                @endforeach
              </select>

            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="buyingDate">Product Buying Date *</label>
              <input id="buyingDate" name="buyingDate" type="date" class="form-control">

            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="expireDate">Product Expire Date *</label>
              <input id="expireDate" name="expireDate" type="date" class="form-control">

            </div>
          </div>
          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="buyingPrice">Product Buying Price *</label>
              <input id="buyingPrice" name="buyingPrice" type="text" class="form-control">

            </div>
          </div>
          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="sellingPrice">Product Selling Price *</label>
              <input id="sellingPrice" name="sellingPrice" type="text" class="form-control">

            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0 " for="image">Product Image *</label>
              <input id="image" name="productImage" type="file" class="form-control">

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

<script type="text/javascript">
  $(document).ready(function() {
    $('#myForm').validate({
      rules: {
        productName: {
          required: true,
        },
        categoryID: {
          required: true,
        },
        supplierID: {
          required: true,
        },
        buyingDate: {
          required: true,
        },
        expireDate: {
          required: true,
        },
        buyingPrice: {
          required: true,
        },
        sellingPrice: {
          required: true,
        },
        productImage: {
          required: true,
        },
      },
      messages: {
        product_name: {
          required: 'Please Enter Product Name',
        },
        category_id: {
          required: 'Please Select Category',
        },
        productName: {
          required: 'Please Enter Product Name',
        },
        categoryID: {
          required: 'Please Select Category',
        },
        supplierID: {
          required: 'Please Select Supplier',
        },

        buyingDate: {
          required: 'Please Select Buying Date',
        },
        expireDate: {
          required: 'Please Select Expire Date',
        },
        buyingPrice: {
          required: 'Please Enter Buying Price',
        },
        sellingPrice: {
          required: 'Please Enter Selling Price',
        },
        productImage: {
          required: 'Please Select Product Image',
        },
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      },
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#image').change(function(e) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#showImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    })
  })
</script>

@endsection