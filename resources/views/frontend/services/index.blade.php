@extends('layouts.frontend')

{{-- ========================================== --}}
{{-- SERVICES INDEX – SEO METADATA (ANATECH)    --}}
{{-- ========================================== --}}
@section('meta_title', 'Services | Anatech – Laboratory Equipment, Industrial Supplies & Scientific Solutions')
@section('meta_description', 'Explore Anatech’s professional services including laboratory equipment supply, scientific instrumentation, calibration support, maintenance, procurement, sourcing, and industrial consumables across Zambia and Southern Africa.')
@section('meta_keywords', 'Anatech services, laboratory equipment Zambia, scientific instruments, calibration services, procurement Zambia, industrial supplies, lab consumables, scientific solutions')

{{-- Canonical & OG --}}
@section('canonical', request()->url() . (request()->has('page') ? '?page='.request('page') : ''))
@section('og_type', 'website')
@section('og_image', asset('assets/img/og-default.jpg'))

@push('meta')
    <meta property="og:locale" content="en_ZM">
    <meta property="article:section" content="Services">
@endpush


{{-- ========================================== --}}
{{-- JSON-LD: SERVICES COLLECTION + BREADCRUMBS --}}
{{-- ========================================== --}}
@push('structured_data')
@php
    // Prepare ItemList
    $listItems = [];
    $start = 1 + (
        max((int)request('page', 1) - 1, 0)
        * max((int)($services->perPage() ?? count($services)), 1)
    );

    $entities = $services instanceof \Illuminate\Contracts\Pagination\Paginator
        ? $services->items()
        : $services;

    foreach ($entities as $svc) {
        $listItems[] = [
            '@type'    => 'ListItem',
            'position' => $start++,
            'url'      => route('services.show', $svc->slug),
            'name'     => $svc->title,
        ];
    }

    // CollectionPage Schema
    $collectionJson = [
        '@context'    => 'https://schema.org',
        '@type'       => 'CollectionPage',
        'name'        => 'Services | Anatech Zambia',
        'url'         => request()->fullUrl(),
        'description' => 'Anatech service catalogue covering laboratory equipment supply, scientific solutions, industrial consumables, and procurement services across Zambia.',
        'mainEntity'  => [
            '@type'           => 'ItemList',
            'itemListElement' => $listItems,
        ],
    ];

    // Breadcrumb Schema
    $breadcrumbsJson = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
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
        ],
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($collectionJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($breadcrumbsJson, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush



{{-- ========================================== --}}
{{-- PAGE CONTENT                               --}}
{{-- ========================================== --}}
@section('content')

<!-- breadcrumb-area -->
         <section class="breadcrumb__area pt-100 pb-120 breadcrumb__overlay" data-background="assets/img/banner/breadcrumb-01.jpg">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-lg-6 col-md-7 col-12">
                     <div class="tp-breadcrumb">
                        <h2 class="tp-breadcrumb__title">Services</h2>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-5 col-12">
                     <div class="tp-breadcrumb__link d-flex align-items-center">
                        <span><a href="{{ url('/') }}"> Home</a></span>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- breadcrumb-area-end -->


    <!-- services-area -->
<section class="services-area pt-120 pb-90 grey-bg"
         data-background="{{ asset('assets/img/shape/shape-bg-01.png') }}">
   <div class="container">

      {{-- Section Heading --}}
      <div class="row text-center">
         <div class="col-lg-12">
            <div class="tp-section">
               <span class="tp-section__sub-title left-line right-line mb-20">Our Services</span>
               <h3 class="tp-section__title mb-70">Service Area</h3>
            </div>
         </div>
      </div>

      {{-- Services Grid --}}
      <div class="row">
         @forelse($services as $index => $service)

            @php
               // Better animation delay: 0.2, 0.4, 0.6 repeating
               $delay = number_format(0.2 + ($index % 3) * 0.2, 1);
            @endphp

            <div class="col-xl-4 col-md-6">

               <!-- NEW WRAPPER CLASS HERE -->
               <div class="services-index-card services-item mb-40 wow fadeInUp"
                    data-wow-delay=".{{ str_replace('.', '', $delay) }}s">

                  {{-- Icon --}}
                  <div class="services-item__icon mb-30">
                     @if(!empty($service->icon))
                        <img src="{{ asset('storage/' . $service->icon) }}"
                             alt="{{ $service->title }}" width="50" height="50">
                     @else
                        <i class="flaticon-biochemistry"></i>
                     @endif
                  </div>

                  {{-- Content --}}
                  <div class="services-item__content">

                     <h4 class="services-item__tp-title mb-20">
                        <a href="{{ route('services.show', $service->slug) }}">
                           {{ $service->title }}
                        </a>
                     </h4>

                     <p>{{ Str::limit(strip_tags($service->short_description ?? $service->description ?? ''), 130) }}</p>

                     <div class="services-item__btn mt-25">
                        <a class="btn-hexa" href="{{ route('services.show', $service->slug) }}">
                           <i></i> Read More
                        </a>
                     </div>

                  </div>
               </div>
            </div>

         @empty
            <div class="col-12">
               <div class="alert alert-info text-center mb-0">
                  No services available at the moment. Please check back soon.
               </div>
            </div>
         @endforelse
      </div>

      {{-- Pagination --}}
      @if(method_exists($services, 'links'))
         <div class="d-flex justify-content-center mt-4">
            {{ $services->links() }}
         </div>
      @endif

   </div>
</section>

<!-- services-area-end -->



<!-- choose-area -->
<section class="choose-area theme-bg pt-120 pb-120">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="tp-section text-center">
                    <span class="tp-section__sub-title left-line right-line mb-25">Trusted Laboratory Solutions</span>
                    <h3 class="tp-section__title title-white mb-85">Why Choose Anatech</h3>
                </div>
            </div>
        </div>

        <div class="row">

            {{-- Quality Products --}}
            <div class="col-xl-3 col-md-6">
                <div class="tp-choose__item ml-15 mb-100 wow fadeInUp" data-wow-delay=".2s">
                    <div class="tp-choose__icon mb-40">
                        <i class="flaticon-microscope"></i>
                    </div>
                    <div class="tp-choose__content">
                        <h4 class="tp-choose__title mb-20">Certified & Reliable<br>Equipment</h4>
                        <p>
                            We supply globally certified laboratory instruments, consumables and chemicals trusted by
                            scientists, researchers and industry professionals.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Fast Delivery / Procurement --}}
            <div class="col-xl-3 col-md-6">
                <div class="tp-choose__item ml-35 mb-100 wow fadeInUp" data-wow-delay=".4s">
                    <div class="tp-choose__icon pink-icon mb-40">
                        <i class="flaticon-thinking"></i>
                    </div>
                    <div class="tp-choose__content">
                        <h4 class="tp-choose__title mb-20">Efficient Procurement<br>Process</h4>
                        <p>
                            Our streamlined sourcing and ordering workflow ensures fast delivery, accurate quotations and
                            dependable supply for laboratories and industries.
                        </p>
                    </div>
                </div>
            </div>

            {{-- 24/7 Support --}}
            <div class="col-xl-3 col-md-6">
                <div class="tp-choose__item ml-55 mb-100 wow fadeInUp" data-wow-delay=".6s">
                    <div class="tp-choose__icon green-icon mb-40">
                        <i class="flaticon-24-hours-1"></i>
                    </div>
                    <div class="tp-choose__content">
                        <h4 class="tp-choose__title mb-20">Technical Support<br>& Maintenance</h4>
                        <p>
                            From installation to after-sales servicing and calibration support, our qualified team ensures
                            your equipment performs optimally at all times.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Expert Team --}}
            <div class="col-xl-3 col-md-6">
                <div class="tp-choose__item ml-75 mb-100 wow fadeInUp" data-wow-delay=".8s">
                    <div class="tp-choose__icon sky-icon mb-40">
                        <i class="flaticon-team"></i>
                    </div>
                    <div class="tp-choose__content">
                        <h4 class="tp-choose__title mb-20">Experienced<br>Professional Team</h4>
                        <p>
                            Our specialists deliver expert guidance in laboratory setup, equipment selection, compliance
                            requirements and scientific procurement solutions.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom Line --}}
        <div class="row text-center">
            <div class="col-lg-12">
                <div class="tp-choose-option">
                    <span>
                        Supporting Laboratories, Industry & Research Across Zambia —
                        <a href="{{ url('/contact-us') }}">Get In Touch <i class="fa-solid fa-arrow-right"></i></a>
                    </span>
                </div>
            </div>
        </div>

    </div>
</section>
         <!-- choose-area-end -->

         

      

@endsection
