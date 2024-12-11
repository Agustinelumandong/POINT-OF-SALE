@extends ('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <a href="{{ route('add.employee') }}"
                                class="btn btn-success rounded-pill waves-effect waves-light">
                                <i class="i-Edit text-25 text-success"></i>All Advance Salary</a>
                        </div>
                        <h4 class="page-title">All Employee</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID NO.</th>
                                        <th>Employee Image</th>
                                        <th>Employee Name</th>
                                        <th>Month</th>
                                        <th>Employee Salary</th>
                                        <th>Advance Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($deletedAdvanceSalary as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($item->employee->employeeImage) }}"
                                                    style="width:50px; height:40px;"></td>
                                            <td>{{ $item['employee']['employeeName'] }}</td>
                                            <td>{{ $item->month }}</td>
                                            <td>{{ $item['employee']['employeeSalary'] }}</td>
                                            <td>{{ $item->advance_salary }}</td>
                                            <td>


                                                <a href="{{ route('restore.advance.salary', $item->id) }}"><i
                                                        class="fa-solid fa-arrow-rotate-left fa-2xl"
                                                        style="color: #74C0FC;"></i></a>&nbsp;&nbsp;&nbsp;

                                            </td>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- end card body-->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-->
            </div>
            <!-- end row-->
        </div>
        <!-- container -->
    </div>
    <!-- content -->
@endsection
