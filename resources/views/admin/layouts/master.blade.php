<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/developer.css') }}">
    <!-- End layout styles -->

    <!-- Toastr for this page(Order is important) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- End Toastr for this page -->

    <link rel="shortcut icon" href="{{ asset('public/admin/assets/images/favicon.png') }}" />
  </head>
  <body>
    @include('admin.elements.toastr_flash')

    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      @include('admin.elements.top_navbar')
      <!-- partial -->

      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        @include('admin.elements.sidebar')
        <!-- partial -->
        <div class="main-panel">

          <div class="content-wrapper">
            <div class="page-header">
              @include('admin.elements.breadcrumb')
            </div>
            <div class="row">
              @yield('content')
            </div>
          </div>
          <!-- content-wrapper ends -->

          <!-- partial:../../partials/_footer.html -->
          @include('admin.elements.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('public/admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('public/admin/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>

    <script src="{{ asset('public/admin/assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('public/admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('public/admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/misc.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/settings.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/jquery.cookie.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('public/admin/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/select2.js') }}"></script>

    <script src="{{ asset('public/admin//js/developer.js') }}"></script>
    <!-- End custom js for this page -->
  </body>
</html>