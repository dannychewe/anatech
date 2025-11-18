<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Favicons --}}
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon_io/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon_io/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon_io/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('assets/img/favicon_io/site.webmanifest') }}">

  {{-- SEO --}}
  @include('layouts.partials.seo')

  {{-- Optional prev/next for pagination (render only if you set $totalPages in controller) --}}
  @php $page = (int) request('page', 1); @endphp
  @isset($totalPages)
    @if($page > 1)
      <link rel="prev" href="{{ request()->fullUrlWithQuery(['page' => $page - 1]) }}">
    @endif
    @if($page < $totalPages)
      <link rel="next" href="{{ request()->fullUrlWithQuery(['page' => $page + 1]) }}">
    @endif
  @endisset

  {{-- JSON-LD --}}
  @include('layouts.partials.jsonld-organization')


  <!-- CSS here -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <!-- Scroll-top -->
      <button class="scroll-top scroll-to-target" data-target="html">
         <i class="fas fa-angle-up"></i>
      </button>
      <!-- Scroll-top-end-->   
      
      <!-- preloader -->
      <div id="preloadertp">
         <img src="{{ asset('assets/img/preloader.png') }}" alt="">
      </div>
      <!-- preloader end  -->      
    {{-- Navbar (optional) --}}
    <!-- Start Header Section -->
    <!-- header-area -->
<header class="d-none d-xl-block">
   <div class="header-custom" id="header-sticky">
      <div class="header-logo-box">
         <a href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="{{ config('app.name') }}">
         </a>
      </div>
      <div class="header-menu-box">
         <div class="header-menu-top">
            <div class="row align-items-center">
               <div class="col-lg-4">
                  <div class="header-top-mob">
                     <svg width="14" height="19" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2" cy="2" r="2" fill="#0E63FF"/>
                        <circle cx="7" cy="2" r="2" fill="#0E63FF"/>
                        <circle cx="12" cy="2" r="2" fill="#0E63FF"/>
                        <circle cx="12" cy="7" r="2" fill="#0E63FF"/>
                        <circle cx="12" cy="12" r="2" fill="#0E63FF"/>
                        <circle cx="7" cy="7" r="2" fill="#0E63FF"/>
                        <circle cx="7" cy="12" r="2" fill="#0E63FF"/>
                        <circle cx="7" cy="17" r="2" fill="#0E63FF"/>
                        <circle cx="2" cy="7" r="2" fill="#0E63FF"/>
                        <circle cx="2" cy="12" r="2" fill="#0E63FF"/>
                     </svg>
                     <span>Help Desk :</span>
                     <a href="tel:{{ $globalFooter->phone ?? '+260 977 000 000' }}">
                        {{ $globalFooter->phone ?? '+260 977 000 000' }}
                     </a>
                  </div>
               </div>
               <div class="col-lg-8">
                  <div class="header-time">
                     <span>
                        <i class="fa-light fa-clock-ten"></i>
                        Monday - Friday 09:00 am - 05:00 pm
                     </span>
                     <!-- <span class="ms-3">
                        <i class="fa-light fa-location-dot"></i>
                        {{ optional($globalFooter)->address ?? 'Your address here' }}
                     </span>
                     <span class="ms-3">
                        <i class="fa-light fa-envelope"></i>
                        <a href="mailto:{{ $globalFooter->email ?? 'info@example.com' }}">
                           {{ $globalFooter->email ?? 'info@example.com' }}
                        </a>
                     </span> -->
                  </div>
               </div>
            </div>
         </div>

         <div class="header-menu-bottom">
            <div class="row">
               <div class="col-lg-7">
                  <div class="main-menu main-menu-second">
                     <nav id="mobile-menu">
                        <ul>
                           <li><a href="{{ url('/') }}">Home</a></li>
                           <li><a href="{{ url('/about-us') }}">About Us</a></li>
                           <li><a href="{{ url('/services') }}">Services</a></li>
                           <li><a href="{{ url('/products') }}">Products</a></li>
                           <li><a href="{{ url('/blogs') }}">Blogs</a></li>
                           <li><a href="{{ url('/contact-us') }}">Contact</a></li>
                        </ul>
                     </nav>
                  </div>
               </div>
               <div class="col-lg-5">
                  <div class="header-cart-order d-flex align-items-center justify-content-end">
                     <a class="header-bottom-btn" href="{{ url('/contact-us') }}">Book Appointment</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</header>
<!-- header-area-end -->

<!-- tp-mobile-header-area start -->
      <div id="header-mob-sticky" class="tp-mobile-header-area pt-15 pb-15 d-xl-none">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-md-4 col-10">
                  <div class="tp-mob-logo">
                     <a href="index.html"><img src="{{ asset('assets/img/logo/logo.png') }}" alt="Anatech"></a>
                  </div>
               </div>
               <div class="col-md-8 col-2">
                  <div class="tp-mobile-bar d-flex align-items-center justify-content-end">
                     <div class="tp-bt-btn-banner d-none d-md-block d-xl-none mr-30">
                        <a class="tp-bt-btn" href="tel:123456">
                           <svg width="14" height="19" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2" fill="#0E63FF"/><circle cx="7" cy="2" r="2" fill="#0E63FF"/><circle cx="12" cy="2" r="2" fill="#0E63FF"/><circle cx="12" cy="7" r="2" fill="#0E63FF"/><circle cx="12" cy="12" r="2" fill="#0E63FF"/><circle cx="7" cy="7" r="2" fill="#0E63FF"/><circle cx="7" cy="12" r="2" fill="#0E63FF"/><circle cx="7" cy="17" r="2" fill="#0E63FF"/><circle cx="2" cy="7" r="2" fill="#0E63FF"/><circle cx="2" cy="12" r="2" fill="#0E63FF"/></svg><span>Help Desk :</span>+91 590 088 55
                        </a>
                     </div>
                     <button class="tp-menu-toggle"><i class="far fa-bars"></i></button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- tp-mobile-header-area end -->

     

      <div class="body-overlay"></div>            
      

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    

    <!-- Start Footer -->
    @include('layouts.partials.footer')
    <!-- End Footer -->



    <!-- JS here -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/counterup.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/meanmenu.js') }}"></script>
    <script src="{{ asset('assets/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.knob.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
