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
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Change Passowrd</a></li>

          </ol>
        </div>
        <h4 class="page-title">Change Passowrd</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <!-- Start Content-->
  <div class="row card user-profile o-hidden mb-30 col-lg-8 col-xl-8">
    <div class="card-body ">
      <form method="post" action="{{ route('update.password') }}">
        @csrf
        <div class="row">
          <!-- Old Password -->
          <div class="col-md-12">
            <div class="mb-3">
              <label for="firstname" class="form-label">Old Password</label>
              <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="current_password">
              @error('old_password')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>



          <div class="col-md-12">
            <div class="mb-3">
              <label for="firstname" class="form-label">New Password</label>
              <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password">
              @error('new_password')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>


          <div class="col-md-12">
            <div class="mb-3">
              <label for="firstname" class="form-label">Confirm New Password</label>
              <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation">

            </div>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
          </div>

        </div>
      </form>
    </div>
  </div>
  <!-- End Content-->
</div>
<!-- End Container -->


@endsection