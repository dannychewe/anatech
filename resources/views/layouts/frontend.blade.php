<!DOCTYPE html>
<html lang="en" class="no-js">
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

  {{-- Pagination SEO (if available) --}}
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

  <!-- CSS -->
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

<!-- Preloader -->
<div id="preloadertp">
   <img src="{{ asset('assets/img/preloader.png') }}" alt="">
</div>

<!-- Desktop Header -->
<header class="d-none d-xl-block">
   <div class="header-custom" id="header-sticky">

      <div class="header-logo-box">
         <a href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Anatech">
         </a>
      </div>

      <div class="header-menu-box">

         <!-- Top Bar -->
         <div class="header-menu-top">
            <div class="row align-items-center">

               <div class="col-lg-4">
                  <div class="header-top-mob">
                     <svg width="14" height="19" viewBox="0 0 14 19" fill="none">
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
                     <a href="tel:{{ $globalFooter->phone ?? '' }}">
                        {{ $globalFooter->phone ?? '+260 977 000 000' }}
                     </a>
                  </div>
               </div>

               <div class="col-lg-8">
                  <div class="header-time">
                     <span><i class="fa-light fa-clock-ten"></i> Monday - Friday 09:00 am - 05:00 pm</span>
                  </div>
               </div>

            </div>
         </div>

         <!-- Menu -->
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

<!-- Mobile Header -->
<div id="header-mob-sticky" class="tp-mobile-header-area pt-15 pb-15 d-xl-none">
   <div class="container">
      <div class="row align-items-center">

         <div class="col-md-4 col-10">
            <div class="tp-mob-logo">
               <a href="{{ url('/') }}">
                   <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Anatech">
               </a>
            </div>
         </div>

         <div class="col-md-8 col-2">
            <div class="tp-mobile-bar d-flex align-items-center justify-content-end">
               <button class="tp-menu-toggle"><i class="far fa-bars"></i></button>
            </div>
         </div>

      </div>
   </div>
</div>

<!-- Sidebar Mobile Menu (CRITICAL PART) -->
<div class="tpsideinfo tp-side-info-area">

   <button class="tpsideinfo__close"><i class="fal fa-times"></i></button>

   <div class="tpsideinfo__logo mb-40">
      <a href="{{ url('/') }}">
         <img src="{{ asset('assets/img/logo/white-logo.png') }}" alt="Anatech">
      </a>
   </div>

   <div class="mobile-menu"></div> {{-- Meanmenu injects mobile navigation here --}}

   <div class="tpsideinfo__content mb-60">
      <p class="d-none d-xl-block">Quality solutions for laboratories, industries & enterprises.</p>
      <span>Contact Us</span>
      <a href="#"><i class="fa-solid fa-star"></i>{{ $globalFooter->address ?? 'Lusaka, Zambia' }}</a>
      <a href="tel:{{ $globalFooter->phone ?? '' }}"><i class="fa-solid fa-star"></i>{{ $globalFooter->phone ?? '' }}</a>
      <a href="mailto:{{ $globalFooter->email ?? '' }}"><i class="fa-solid fa-star"></i>{{ $globalFooter->email ?? '' }}</a>
   </div>

</div>

<div class="body-overlay"></div>

<!-- Main Content -->
<main>
   @yield('content')
</main>

<!-- Footer -->
@include('layouts.partials.footer')

<!-- JS -->
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
