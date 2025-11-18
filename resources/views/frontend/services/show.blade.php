@extends('layouts.frontend')

{{-- ========================================== --}}
{{-- ANATECH — SERVICE DETAIL SEO METADATA       --}}
{{-- ========================================== --}}
@section('meta_title',       $service->meta_title ?? ($service->title.' | '.config('app.name')))
@section('meta_description', $service->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($service->excerpt ?? $service->description), 155))
@section('meta_keywords',    $service->meta_keywords ?? 'laboratory equipment, scientific services, calibration, maintenance, procurement, industrial supplies, Anatech Zambia')

{{-- Canonical + OG --}}
@section('canonical', route('services.show', $service->slug))
@section('og_type', 'article')
@section('og_image', $service->image ? asset('storage/'.$service->image) : asset('assets/img/og-default.jpg'))


{{-- ========================================== --}}
{{-- OPTIONAL: Product-like OG price tags        --}}
{{-- ========================================== --}}
@push('meta')
  @if(!is_null($service->price))
    <meta property="product:price:amount" content="{{ number_format((float)$service->price, 2, '.', '') }}">
    <meta property="product:price:currency" content="USD">
  @endif
@endpush


{{-- ========================================== --}}
{{-- JSON-LD — SERVICE SCHEMA                    --}}
{{-- ========================================== --}}
@push('structured_data')
@php
  $image = $service->image
            ? asset('storage/'.$service->image)
            : asset('assets/img/og-default.jpg');

  $serviceJson = [
    '@context'    => 'https://schema.org',
    '@type'       => 'Service',
    'name'        => $service->title,
    'url'         => route('services.show', $service->slug),
    'image'       => [$image],
    'description' => strip_tags(
                        $service->meta_description
                        ?? \Illuminate\Support\Str::limit(strip_tags($service->excerpt ?? $service->description), 155)
                     ),

    'provider' => [
      '@type' => 'Organization',
      'name'  => 'Analytical Technologies Zambia Ltd. (Anatech)',
      'url'   => url('/'),
      'logo'  => asset('assets/img/logo/logo.png'),
      'address' => optional($globalFooter)->address ?? 'Lusaka, Zambia',
      'telephone' => optional($globalFooter)->phone ?? '+260 000 000 000',
      'email'     => optional($globalFooter)->email ?? 'info@anatech.co.zm',
    ],

    'areaServed' => [
      ['@type' => 'Country', 'name' => 'Zambia'],
      ['@type' => 'Place',   'name' => 'Southern Africa'],
    ],
  ];

  if (!is_null($service->price)) {
    $serviceJson['offers'] = [
      '@type'         => 'Offer',
      'price'         => number_format((float)$service->price, 2, '.', ''),
      'priceCurrency' => 'USD',
      'availability'  => 'https://schema.org/InStock',
      'url'           => route('services.show', $service->slug),
    ];
  }

  // Breadcrumbs
  $breadcrumbs = [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      [
        '@type'    => 'ListItem',
        'position' => 1,
        'name'     => 'Home',
        'item'     => url('/'),
      ],
      [
        '@type'    => 'ListItem',
        'position' => 2,
        'name'     => 'Services',
        'item'     => url('/services'),
      ],
      [
        '@type'    => 'ListItem',
        'position' => 3,
        'name'     => $service->title,
        'item'     => route('services.show', $service->slug),
      ],
    ],
  ];
@endphp

<script type="application/ld+json">
{!! json_encode($serviceJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush


{{-- ========================================== --}}
{{-- PAGE CONTENT --}}
{{-- ========================================== --}}
@section('content')


<!-- breadcrumb-area -->
<section class="breadcrumb__area pt-100 pb-120 breadcrumb__overlay"
         data-background="{{ $service->image ? asset('storage/'.$service->image) : asset('assets/img/banner/breadcrumb-01.jpg') }}">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-xl-6 col-lg-7 col-md-12 col-12">
                <div class="tp-breadcrumb">
                    <h2 class="tp-breadcrumb__title">{{ $service->title }}</h2>
                </div>
            </div>

            <div class="col-xl-6 col-lg-5 col-md-12 col-12">
                <div class="tp-breadcrumb__link serv-md d-flex text-white">
                    <span>
                        Matcon Systems :
                        <a href="{{ route('services.show', $service->slug) }}"> {{ $service->title }}</a>
                    </span>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- breadcrumb-area-end -->


<!-- services-details-area -->
<section class="services-details pt-130 pb-120">
    <div class="container">

        {{-- Service Images --}}
        <div class="row">

            {{-- Main image --}}
            <div class="col-lg-6 col-md-12">
                <div class="services-thumb-img mb-50 wow fadeInLeft" data-wow-delay=".4s">
                    <img src="{{ $service->image ? asset('storage/'.$service->image) : asset('assets/img/services/services-thumb-07.jpg') }}"
                         alt="{{ $service->title }}">
                </div>
            </div>

            {{-- Optional secondary image --}}
            <!-- <div class="col-lg-6 col-md-12">
                <div class="services-thumb-img mb-50 wow fadeInRight" data-wow-delay=".4s">
                    <img src="{{ $service->cover_image ? asset('storage/'.$service->cover_image) : asset('assets/img/services/services-thumb-08.jpg') }}"
                         alt="{{ $service->title }}">
                </div>
            </div> -->

        </div>


        {{-- Service Description --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="tp-srv-process mb-50">

                    {{-- Title --}}
                    <h2 class="mb-20">{{ $service->title }}</h2>

                    {{-- Optional price --}}
                    <!-- @if(!is_null($service->price))
                        <p class="fw-bold mb-20">Price: ${{ number_format($service->price, 2) }}</p>
                    @endif -->

                    {{-- HTML Description --}}
                    <div class="service-description">
                        {!! $service->description !!}
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<!-- services-details-area-end -->


<!-- support-area / booking section -->
@if($service->is_featured)
<section class="support-area grey-bg pt-125 pb-130">
    <div class="container">

        <div class="row text-center">
            <div class="col-lg-12">
                <div class="tp-section">
                    <span class="tp-section__sub-title left-line right-line mb-20">Book This Service</span>
                    <h3 class="tp-section__title mb-70">Request a Booking</h3>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
           <div class="col-xl-10 col-lg-12">

              {{-- Success Flash --}}
              @if(session('success'))
                  <div class="alert alert-success mb-4">{{ session('success') }}</div>
              @endif

              <div class="tp-support-form text-center">
                    <span>Direct contact with us</span>

                    <form action="{{ route('frontend.booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">

                        <input type="text" name="customer_name" placeholder="Enter your Name"
                               value="{{ old('customer_name') }}" required>
                        @error('customer_name') <small class="text-danger">{{ $message }}</small> @enderror

                        <input type="email" name="customer_email" placeholder="Enter your Email"
                               value="{{ old('customer_email') }}" required>
                        @error('customer_email') <small class="text-danger">{{ $message }}</small> @enderror

                        <input type="text" name="customer_phone" placeholder="Enter your Phone (optional)"
                               value="{{ old('customer_phone') }}">
                        @error('customer_phone') <small class="text-danger">{{ $message }}</small> @enderror

                        <input type="text" name="location" placeholder="Enter your Location (optional)"
                               value="{{ old('location') }}">
                        @error('location') <small class="text-danger">{{ $message }}</small> @enderror

                        <input type="date" name="start_date"
                               min="{{ \Carbon\Carbon::today()->toDateString() }}"
                               value="{{ old('start_date') }}" required>
                        @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror

                        <input type="date" name="end_date"
                               min="{{ \Carbon\Carbon::today()->toDateString() }}"
                               value="{{ old('end_date') }}" required>
                        @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror

                        <input type="number" name="quantity" min="1" placeholder="Quantity"
                               value="{{ old('quantity', 1) }}">
                        @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror

                        <textarea name="notes" placeholder="Type your message">{{ old('notes') }}</textarea>
                        @error('notes') <small class="text-danger">{{ $message }}</small> @enderror

                    </form>

                    <div class="tp-support-form__btn mt-3">
                        <button class="tp-btn" type="submit" form="booking-form">Send Message</button>
                    </div>
              </div>

           </div>
        </div>

    </div>
</section>
@else
<section class="support-area grey-bg pt-125 pb-130">
    <div class="container text-center">
        <div class="alert alert-info">
            This service is not available for online booking.  
            Please <a href="{{ url('/contact-us') }}">contact us</a> for a quote.
        </div>
    </div>
</section>
@endif

@endsection

