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
                    <h4 class="page-title">Import Product</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Start Content-->
        <div class="row card user-profile o-hidden mb-30">
            <div class="card-body">
                <form method="post" action="{{ route('import.product') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label pt-0" for="importProduct">Xlsx File Import *</label>
                                <input id="importProduct" name="importProduct" type="file" class="form-control">
                            </div>


                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                    class="mdi mdi-content-save"></i> UPLOAD</button>
                        </div>

                    </div>
                </form>
            </div>
            <!-- End Content-->

        </div>
        <!-- End Container -->

    </div>
@endsection
