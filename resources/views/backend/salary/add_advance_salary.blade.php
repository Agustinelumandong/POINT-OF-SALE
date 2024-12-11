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
                    <h4 class="page-title">Add Advance Salary</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Start Content-->
        <div class="row card user-profile o-hidden mb-30">
            <div class="card-body">
                <form method="post" action="{{ route('advance.salary.store') }}">
                    @csrf


                    <div class="row">


                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label pt-0 " for="employee_id">Employee Name *</label>
                                <select name="employee_id" id="employee_id"
                                    class="form-select @error('employee_id') is-invalid @enderror">
                                    <option selected disabled>Select Employee</option>
                                    @foreach ($employee as $item)
                                        <option value="{{ $item->id }}">{{ $item->employeeName }}</option>
                                    @endforeach

                                </select>
                                @error('employee_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class=" col-sm-12 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label pt-0" id="employeePhone">Advance Salary *</label>
                                <input type="text" id="advance_salary" name="advance_salary" type="text"
                                    class="form-control @error('advance_salary') is-invalid @enderror">
                                @error('advance_salary')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>





                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label pt-0 " for="image">Salary Month *</label>
                                <select name="month" id="month"
                                    class="form-select @error('month') is-invalid @enderror">
                                    <option selected disabled>Select Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                                @error('month')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label pt-0 " for="image">Salary Year *</label>
                                <select name="year" id="year"
                                    class="form-select @error('year') is-invalid @enderror">
                                    <option selected disabled>Select Month</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>

                                </select>
                                @error('year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                    class="mdi mdi-content-save"></i> Save</button>
                        </div>

                    </div>
                </form>
            </div>
            <!-- End Content-->

        </div>
        <!-- End Container -->

    </div>
@endsection
