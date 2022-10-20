<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    @yield('title')

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin_gentelella/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_gentelella/vendors/font-awesome/css/font-awesome.min.css')}}" >
    <!-- NProgress -->
    <link rel="stylesheet" href="{{ asset('admin_gentelella/vendors/nprogress/nprogress.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin_gentelella/vendors/iCheck/skins/flat/green.css')}}" >
	
    <!-- bootstrap-progressbar -->
    <link rel="stylesheet" href="{{ asset('admin_gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('admin_gentelella/vendors/jqvmap/dist/jqvmap.min.css')}}"/>
    <!-- bootstrap-daterangepicker -->
    <link rel="stylesheet" href="{{ asset('admin_gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css')}}">


    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="{{ asset('admin_gentelella/build/css/custom.min.css')}}">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->
            @include('admin.partials.siderbar')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        @include('admin.partials.header')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          @yield('content')
        </div>
        
        <!-- /page content -->

        <!-- footer content -->
        @include('admin.partials.footer')
        <!-- /footer content -->
      </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('admin_gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('admin_gentelella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin_gentelella/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ asset('admin_gentelella/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('admin_gentelella/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('admin_gentelella/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('admin_gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('admin_gentelella/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{ asset('admin_gentelella/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{ asset('admin_gentelella/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('admin_gentelella/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('admin_gentelella/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('admin_gentelella/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ asset('admin_gentelella/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('admin_gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ asset('admin_gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ asset('admin_gentelella/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{ asset('admin_gentelella/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('admin_gentelella/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{ asset('admin_gentelella/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{ asset('admin_gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('admin_gentelella/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('admin_gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('admin_gentelella/build/js/custom.min.js')}}"></script>

    <!-- tinymce-editor -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script> 
    <script type="text/javascript">
      tinymce.init({
        selector: 'textarea.my-editor',
        plugins: "image code",
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function () {
                var file = this.files[0];
                var reader = new FileReader();
    
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {title: file.name});
                };
                reader.readAsDataURL(file);
            };
            input.click();
        }
      });
      </script>
	
  </body>
</html>
