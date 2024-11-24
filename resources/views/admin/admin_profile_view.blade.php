@extends('admin_dashboard')
@section('admin')



<!-- Start Container-->
<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Profile</a></li>

          </ol>
        </div>
        <h4 class="page-title">Admin Profile</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <!-- Start Content-->
  <div class="row card user-profile o-hidden mb-30">
    <div class="w-auto bg-image header-cover"></div>
    <div class="user-info">
      <img src="{{ (!empty($adminData->photo)) ? 
        url("upload/admin_image/{$adminData->photo}") : 
        url('upload/no_image.jpg') }}" alt="" class="profile-picture avatar-xxl mb-2 rounded-circle shadow">
      <p class="m-0 text-24 fw-bolder fs-3">{{ $adminData->name }}</p>
    </div>

    <div class="card-body">
      <form>
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label class="col-form-label pt-0" for="name">Name *</label>
              <input id="name" name="name" value="{{ $adminData->name }}" type="text" class="form-control">
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label class="form-label pt-0" for="email">Email *</label>
              <input name="email" type="text" class="form-control" value="{{ $adminData->email }}">

            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label class="form-label pt-0" id="phone">Phone *</label>
              <input name="phone" type="text" class="form-control" value="{{ $adminData->phone }}">
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label class="form-label pt-0" for="photo">User Image</label>
              <input id="photo" name="photo" type="file" class="form-control">
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