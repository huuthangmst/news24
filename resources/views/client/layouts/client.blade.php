<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @yield('title')
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/ticker-style.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('news_templates/assets/css/style.css') }}">
    {{-- rating --}}
    

</head>

<body>

    <!-- Preloader Start -->
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div> -->
    <!-- Preloader Start -->

    <!-- header -->
    @include('client.partials.header')

    {{-- content --}}
    @yield('content')

    <!-- Footer -->
    @include('client.partials.footer')

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="{{ asset('news_templates/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('news_templates/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('news_templates/assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('news_templates/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/slick.min.js') }}"></script>
    <!-- Date Picker -->
    <script src="{{ asset('news_templates/assets/js/gijgo.min.js') }}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('news_templates/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/animated.headline.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- Breaking New Pluging -->
    <script src="{{ asset('news_templates/assets/js/jquery.ticker.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/site.js') }}"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="{{ asset('news_templates/assets/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/jquery.sticky.js') }}"></script>

    <!-- contact js -->
    <script src="{{ asset('news_templates/assets/js/contact.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/mail-script.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('news_templates/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('news_templates/assets/js/main.js') }}"></script>

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
            file_picker_callback: function (cb, value, meta) {
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
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            }
        });

    </script>
    <script type="text/javascript">
        function showReplyForm(commentId){
            var x = document.getElementById(`reply-form-${commentId}`);
    
            if (x.style.display === "none") {
                x.style.display = "block";
            }else{
                x.style.display = "none";
            }
            
        }
    </script>

</body>

</html>
