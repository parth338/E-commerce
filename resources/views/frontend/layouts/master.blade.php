<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
   
    <title>
        @yield('title')
    </title>

    @yield('metas')

    <link rel="icon" type="image/png" href="{{ asset($logoSetting->favicon) }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/add_row_custon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/mobile_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.exzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/multiple-image-video.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/ranger_style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/jquery.classycountdown.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/venobox.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/responsive.css') }}">
    @if ($settings->layout === 'RTL')
        <link rel="stylesheet" href="{{ asset('public/frontend/css/rtl.css') }}">
    @endif
    @vite(['resources/js/app.js'])
</head>

<body>

    <!--============================
        HEADER START
    ==============================-->
    @include('frontend.layouts.header')
    <!--============================
        HEADER END
    ==============================-->


    <!--============================
        MAIN MENU START
    ==============================-->
    @include('frontend.layouts.menu')
    <!--============================
        MAIN MENU END
    ==============================-->


    <!--============================
        Main Content Start
    ==============================-->
    @yield('content')
    <!--============================
       Main Content End
    ==============================-->


    <section class="product_popup_modal">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content product-modal-content">

                </div>
            </div>
        </div>
    </section>

    <!--============================
        FOOTER PART START
    ==============================-->
    @include('frontend.layouts.footer')
    <!--============================
        FOOTER PART END
    ==============================-->


    <!--============================
        SCROLL BUTTON START
    ==============================-->
    <div class="wsus__scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--============================
        SCROLL BUTTON  END
    ==============================-->


    <!--jquery library js-->
    <script src="{{ asset('public/frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('public/frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('public/frontend/js/Font-Awesome.js') }}"></script>
    <!--select2 js-->
    <script src="{{ asset('public/frontend/js/select2.min.js') }}"></script>
    <!--slick slider js-->
    <script src="{{ asset('public/frontend/js/slick.min.js') }}"></script>
    <!--simplyCountdown js-->
    <script src="{{ asset('public/frontend/js/simplyCountdown.js') }}"></script>
    <!--product zoomer js-->
    <script src="{{ asset('public/frontend/js/jquery.exzoom.js') }}"></script>
    <!--nice-number js-->
    <script src="{{ asset('public/frontend/js/jquery.nice-number.min.js') }}"></script>
    <!--counter js-->
    <script src="{{ asset('public/frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.countup.min.js') }}"></script>
    <!--add row js-->
    <script src="{{ asset('public/frontend/js/add_row_custon.js') }}"></script>
    <!--multiple-image-video js-->
    <script src="{{ asset('public/frontend/js/multiple-image-video.js') }}"></script>
    <!--sticky sidebar js-->
    <script src="{{ asset('public/frontend/js/sticky_sidebar.js') }}"></script>
    <!--price ranger js-->
    <script src="{{ asset('public/frontend/js/ranger_jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/ranger_slider.js') }}"></script>
    <!--isotope js-->
    <script src="{{ asset('public/frontend/js/isotope.pkgd.min.js') }}"></script>
    <!--venobox js-->
    <script src="{{ asset('public/frontend/js/venobox.min.js') }}"></script>
    <!--Toaster js-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!--Sweetalert js-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--classycountdown js-->
    <script src="{{ asset('public/frontend/js/jquery.classycountdown.js') }}"></script>


    <!--main/custom js-->
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('.auto_click').click();
        })
    </script>
    @include('frontend.layouts.scripts')
    @stack('scripts')


</body>
<script>
    var botmanWidget = {
        chatServer: "/Multi%20vendor%20ecommerce%20source%20code/botman",
        aboutText: 'query',
        introMessage: "✋ Hi wecome to our site!",
        frameEndpoint: "/Multi%20vendor%20ecommerce%20source%20code/botman/chat",
        mobile: true,  // Enable mobile support
        bubbleAvatarUrl: '{{ asset('public/uploads/images.png') }}', // Optional: Set an avatar image
        title: 'Chat Support', // Customize title
        mainColor: '#0084ff', // Adjust color theme
        bubbleBackground: '#0084ff', // Bubble color
        // desktopHeight: 450, // Desktop size
        // desktopWidth: 370, 
        mobileHeight: 400, // Mobile size
        mobileWidth: 300,
    };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    
</html>
