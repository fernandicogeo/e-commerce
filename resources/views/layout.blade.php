<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - Easy Data</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" href="{{ asset('/style/images/logo.png') }}">
        <link rel="shortcut icon" type="image/ico" href="{{ asset('/style/images/logo.png') }}" />
        <!-- Plugin-CSS -->
        <link rel="stylesheet" href="{{ asset('/style/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/style/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/style/css/linearicons.css') }}">
        <link rel="stylesheet" href="{{ asset('/style/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('/style/css/animate.css') }}">
        <!-- Main-Stylesheets -->
        <link rel="stylesheet" href="{{ asset('/style/css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('/style/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/style/css/responsive.css') }}">
    
        <link href="{{ asset('/style/fontawesome/css/all.css') }}" rel="stylesheet">
        
        <script src="{{ asset('/style/js/vendor/modernizr-2.8.3.min.js') }}"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
        <!-- CSS -->
        <link href="{{ asset('/style/product-page/style.css') }}" rel="stylesheet">
        <style>
            icon-shape {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                vertical-align: middle;
            }

            .icon-sm {
                width: 2rem;
                height: 2rem;
                
            }
        </style>
    </head>
    <body data-spy="scroll" data-target=".mainmenu-area">
        <!-- NavBar -->
        <nav class="mainmenu-area" data-spy="affix" data-offset-top="200">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary_menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('/style/images/logo.png') }}" alt="Logo"></a>
                </div>
                <div class="collapse navbar-collapse" id="primary_menu">
                    <ul class="nav navbar-nav mainmenu">
                        <li class="@yield('home')"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="@yield('contact-us')"><a href="{{ route('contact-us') }}">Hubungi Kami</a></li>
                        <li class="@yield('login')"><a href="{{ route('home') }}">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('isi')

        
            <!-- Footer-Bootom -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 text-center">
                            <span>Copyright Easy Data &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</span>
                        </div>
                        <div class="col-md-7">
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="https://instagram.com/easy_data_" target="_blank">Instagram</a></li>
                                    <li><a href="mailto:easydata2302@gmail.com">Email</a></li>
                                    {{-- <li><a href="https://api.whatsapp.com/send?phone={{ $about->whatsapp }}/">Whatsapp</a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer-Bootom-End -->

        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="{{ asset('/style/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('/style/js/vendor/jquery-ui.js') }}"></script>
        <script src="{{ asset('/style/js/vendor/bootstrap.min.js') }}"></script>
        <!--Plugin-JS-->
        <script src="{{ asset('/style/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('/style/js/contact-form.js') }}"></script>
        <script src="{{ asset('/style/js/ajaxchimp.js') }}"></script>
        {{-- <script src="{{ asset('/style/js/scrollUp.min.js') }}"></script> --}}
        <script src="{{ asset('/style/js/magnific-popup.min.js') }}"></script>
        <script src="{{ asset('/style/js/wow.min.js') }}"></script>
        <!--Main-active-JS-->
        <script src="{{ asset('/style/js/main.js') }}"></script>
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="{{ asset('/style/product-page/script.js') }}" charset="utf-8"></script>
    </body>
</html>
