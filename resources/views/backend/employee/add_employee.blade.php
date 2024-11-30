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
        <h4 class="page-title">Add Employee</h4>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <!-- Start Content-->
  <div class="row card user-profile o-hidden mb-30">
    <div class="card-body">
      <form method="post" action="{{ route('store.employee') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="col-form-label pt-0" for="employeeName">Employee Name *</label>
              <input id="employeeName" name="employeeName" type="text" class="form-control @error('employeeName') is-invalid @enderror">
              @error('employeeName')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" for="employeeEmail">Employee Email *</label>
              <input id="employeeEmail" name="employeeEmail" type="text" class="form-control @error('employeeEmail') is-invalid @enderror">
              @error('employeeEmail')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="employeePhone">Employee Phone *</label>
              <input id="employeePhone" name="employeePhone" type="text" class="form-control @error('employeePhone') is-invalid @enderror">
              @error('employeePhone')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="employeeSalary">Employee Salary *</label>
              <input id="employeeSalary" name="employeeSalary" type="text" class="form-control @error('employeeSalary') is-invalid @enderror">
              @error('employeeSalary')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class=" col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0" id="employeeVacation">Employee Vacation *</label>
              <input id="employeeVacation" name="employeeVacation" type="text" class="form-control @error('employeeVacation') is-invalid @enderror">
              @error('employeeVacation')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <div class="col-sm-12 col-md-6">
            <div class="form-group mb-2">
              <label class="form-label pt-0 " for="image">Image *</label>
              <input id="image" name="employeeImage" type="file" class="form-control @error('employeeImage') is-invalid @enderror">
              @error('employeeImage')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>

          <!-- <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <img id="showImage" src="{{ asset(url('upload/no_image.jpg')) }}" alt="employee-image" class="rounded-circle avatar-lg img-thumbnail">
            </div>
          </div> -->

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