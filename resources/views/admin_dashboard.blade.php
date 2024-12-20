<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>POS System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{asset('backend/assets/images/pos-logo.png')}}">

  <!--  {{asset('backend/')}}  -->

  <!-- Plugins css -->
  <link href="{{asset('backend/assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('backend/assets/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />

  <!-- Bootstrap css -->
  <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

  <!-- icons -->
  <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

  <!-- Head js -->
  <script src="{{asset('backend/assets/js/head.js')}}"></script>

  <!-- dataTables -->
  <link href="{{ asset('backend/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('backend/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- dataTables end -->

  <!-- toastr css -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<!-- body start -->

<body data-layout-mode="default" data-theme="light" data-topbar-color="light" data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>

  <!-- Begin page -->
  <div id="wrapper">


    <!-- Header Start -->
    @include('body.header')
    <!-- end Header -->

    <!-- ========== Left Sidebar Start ========== -->
    @include('body.sidebar')
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">

      @yield('admin')

      <!-- Footer Start -->
      @include('body.footer')
      <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


  </div>
  <!-- END wrapper -->

  <!-- Right Sidebar -->
  <div class="right-bar">
    <div data-simplebar class="h-100">

      <!-- Nav tabs -->
      <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">

        <li class="nav-item">
          <a class="nav-link py-2 active" data-bs-toggle="tab" href="#settings-tab" role="tab">
            <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
          </a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content pt-0">



        <div class="tab-pane active" id="settings-tab" role="tabpanel">
          <h6 class="fw-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
            <span class="d-block py-1">Theme Settings</span>
          </h6>

          <div class="p-3">
            <div class="alert alert-warning" role="alert">
              <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
            </div>

            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="layout-color" value="light"
                id="light-mode-check" checked />
              <label class="form-check-label" for="light-mode-check">Light Mode</label>
            </div>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="layout-color" value="dark"
                id="dark-mode-check" />
              <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
            </div>

            <!-- Width -->
            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Width</h6>
            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="layout-width" value="fluid" id="fluid-check" checked />
              <label class="form-check-label" for="fluid-check">Fluid</label>
            </div>
            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="layout-width" value="boxed" id="boxed-check" />
              <label class="form-check-label" for="boxed-check">Boxed</label>
            </div>

            <!-- Menu positions -->
            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="menu-position" value="fixed" id="fixed-check"
                checked />
              <label class="form-check-label" for="fixed-check">Fixed</label>
            </div>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="menu-position" value="scrollable"
                id="scrollable-check" />
              <label class="form-check-label" for="scrollable-check">Scrollable</label>
            </div>

            <!-- Left Sidebar-->
            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="leftbar-color" value="light" id="light-check" />
              <label class="form-check-label" for="light-check">Light</label>
            </div>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="leftbar-color" value="dark" id="dark-check" checked />
              <label class="form-check-label" for="dark-check">Dark</label>
            </div>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="leftbar-color" value="brand" id="brand-check" />
              <label class="form-check-label" for="brand-check">Brand</label>
            </div>

            <div class="form-check form-switch mb-3">
              <input type="checkbox" class="form-check-input" name="leftbar-color" value="gradient" id="gradient-check" />
              <label class="form-check-label" for="gradient-check">Gradient</label>
            </div>

            <!-- size -->
            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="leftbar-size" value="default"
                id="default-size-check" checked />
              <label class="form-check-label" for="default-size-check">Default</label>
            </div>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="leftbar-size" value="condensed"
                id="condensed-check" />
              <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
            </div>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="leftbar-size" value="compact"
                id="compact-check" />
              <label class="form-check-label" for="compact-check">Compact <small>(Small size)</small></label>
            </div>

            <!-- User info -->
            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="sidebar-user" value="fixed" id="sidebaruser-check" />
              <label class="form-check-label" for="sidebaruser-check">Enable</label>
            </div>


            <!-- Topbar -->
            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="topbar-color" value="dark" id="darktopbar-check"
                checked />
              <label class="form-check-label" for="darktopbar-check">Dark</label>
            </div>

            <div class="form-check form-switch mb-1">
              <input type="checkbox" class="form-check-input" name="topbar-color" value="light" id="lighttopbar-check" />
              <label class="form-check-label" for="lighttopbar-check">Light</label>
            </div>



          </div>
        </div>
      </div>

    </div> <!-- end slimscroll-menu-->
  </div>
  <!-- /Right-bar -->

  <!-- Right bar overlay-->
  <div class="rightbar-overlay"></div>

  <!-- Vendor js -->
  <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>

  <!-- Plugins js-->
  <script src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

  <script src="{{ asset('backend/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>

  <!-- Dashboar 1 init js-->
  <script src="{{ asset('backend/assets/js/pages/dashboard-1.init.js') }}"></script>

  <!-- App js-->
  <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>



  <!-- datatables js -->
  <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
  <script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
  <!-- third party js ends -->


  <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>
  <!-- Datatables Eend -->

  <!-- Toastr js -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="{{ asset('backend/assets/js/code.js') }}"></script>
  <script src="{{ asset('backend/assets/js/validate.min.js') }}"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- Toastr js -->

  <script src="https://kit.fontawesome.com/e7de5c3ff6.js" crossorigin="anonymous"></script>

  @if(Session::has('message'))
  <!-- If there is a 'message' in the session, execute the following script -->
  <script>
    // Get the alert type from the session, defaulting to 'info' if not set
    var type = "{{ Session::get('alert-type','info') }}";
    // Get the message from the session
    var message = "{{ Session::get('message') }}";

    // Switch statement to handle different types of alerts
    switch (type) {
      case 'info':
        // Display an informational toastr notification
        toastr.info(message);
        break;

      case 'success':
        // Display a success toastr notification
        toastr.success(message);
        break;

      case 'warning':
        // Display a warning toastr notification
        toastr.warning(message);
        break;

      case 'error':
        // Display an error toastr notification
        toastr.error(message);
        break;
    }
  </script>
  @endif
</body>

</html>