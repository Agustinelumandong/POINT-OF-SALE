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
        <h4 class="page-title">Add Expense</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <!-- Start Content-->
  <div class="row card user-profile o-hidden mb-30">
    <div class="card-body">
      <form method="post" action="{{ route('store.expense') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">

          <div class="col-sm-12 col-md-12">
            <div class="form-group mb-2">
              <label class="col-form-label pt-0" for="expenseDetails	">Expense Details *</label>
              <textarea name="expenseDetails" id="expenseDetails" class="form-control" rows="3"></textarea>
              @error('expenseDetails')
              <span class="text-danger"> {{ $message }} </span>
              @endError
            </div>
          </div>

          <div class="col-sm-12 col-md-12">
            <div class="form-group mb-2">
              <label class="col-form-label pt-0" for="expenseAmount">Expense Amount *</label>
              <input id="expenseAmount" name="expenseAmount" type="text" class="form-control @error('expenseAmount') is-invalid @enderror">
              @error('expenseAmount')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class="col-sm-12 col-md-12">
            <div class="form-group mb-2">
              <input id="expenseDate" name="expenseDate" type="hidden" class="form-control @error('expenseDate') is-invalid @enderror" value="{{ date('d-m-Y') }}">
              @error('expenseDate')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class="col-sm-12 col-md-12">
            <div class="form-group mb-2">
              <input id="expenseMonth" name="expenseMonth" type="hidden" class="form-control @error('expenseMonth') is-invalid @enderror" value="{{ date('F') }}">
              @error('expenseMonth')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class="col-sm-12 col-md-12">
            <div class="form-group mb-2">
              <input id="expenseYear" name="expenseYear" type="hidden" class="form-control @error('expenseYear') is-invalid @enderror" value="{{ date('Y') }}">
              @error('expenseYear')
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

@endSection