@extends('layouts.frontend')

{{-- =============================== --}}
{{-- ABOUT PAGE SEO – ANATECH ZAMBIA --}}
{{-- =============================== --}}

@section('meta_title', $about->meta_title ?? 'About Anatech | Laboratory Equipment, Scientific Instruments & Industrial Supplies in Zambia')

@section('meta_description', $about->meta_description ??
    'Anatech is a trusted supplier of laboratory equipment, analytical instruments, chemicals, reagents, calibration tools, and industrial consumables across Zambia — delivering quality, compliance, and technical support for scientific and industrial environments.'
)

@section('meta_keywords', $about->meta_keywords ??
    'Anatech Zambia, laboratory equipment supplier, scientific equipment, analytical instruments, lab chemicals, reagents, industrial consumables, calibration equipment, Zambia labs'
)

{{-- Canonical & Open Graph --}}
@section('canonical', url('/about-us'))
@section('og_type', 'article')

@hasSection('og_image')
    {{-- Use page-specific OG image if defined --}}
@else
    @section('og_image', $about->image ? asset('storage/'.$about->image) : asset('assets/img/og-default.jpg'))
@endif

@push('meta')
    <meta property="og:locale" content="en_ZM">
    <meta property="article:section" content="About">
@endpush

{{-- Optional timestamps --}}
@push('meta')
    @if(!empty($about->updated_at))
        <meta property="article:modified_time"
              content="{{ \Illuminate\Support\Carbon::parse($about->updated_at)->toIso8601String() }}">
    @endif
    @if(!empty($about->published_at))
        <meta property="article:published_time"
              content="{{ \Illuminate\Support\Carbon::parse($about->published_at)->toIso8601String() }}">
    @endif
@endpush


{{-- =============================== --}}
{{-- STRUCTURED DATA (JSON-LD) --}}
{{-- =============================== --}}
@push('structured_data')
@php
    $cleanDesc = $about->meta_description
        ?? 'Anatech supplies high-quality laboratory and scientific equipment, chemicals, consumables, and technical services across Zambia.';

    $cleanDesc = trim(preg_replace('/\s+/', ' ', strip_tags($cleanDesc)));

    $orgJson = [
        '@context' => 'https://schema.org',
        '@type'    => 'AboutPage',
        'name'     => $about->title ?? 'About Anatech Zambia',
        'url'      => url('/about-us'),
        'description' => $cleanDesc,

        'mainEntity' => [
            '@type' => 'Organization',
            'name'  => 'Anatech Zambia',
            'url'   => url('/'),
            'logo'  => asset('assets/img/logo/logo.png'),
            'description' => $cleanDesc,
            'sameAs' => array_values(array_filter([
                $globalFooter->facebook ?? null,
                $globalFooter->linkedin ?? null,
                $globalFooter->instagram ?? null,
            ])),
            'contactPoint' => [[
                '@type' => 'ContactPoint',
                'contactType' => 'Customer Support',
                'telephone' => $globalFooter->phone ?? null,
                'email'     => $globalFooter->email ?? null,
                'areaServed'=> 'ZM',
            ]],
        ],
    ];

    $breadcrumbsJson = [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type'   => 'ListItem',
                'position'=> 1,
                'name'    => 'Home',
                'item'    => url('/')
            ],
            [
                '@type'   => 'ListItem',
                'position'=> 2,
                'name'    => 'About Anatech',
                'item'    => url('/about-us')
            ],
        ],
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($orgJson, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($breadcrumbsJson, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush


@section('content')
@php
    $img = $about->image
        ? asset('storage/'.$about->image)
        : asset('assets/img/about/default-about.jpg');
@endphp

<!-- breadcrumb -->
<section class="breadcrumb__area pt-100 pb-120 breadcrumb__overlay"
         data-background="{{ $img }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7">
                <div class="tp-breadcrumb">
                    <h2 class="tp-breadcrumb__title">{{ $about->title ?? 'About Us' }}</h2>
                </div>
            </div>
         
        </div>
    </div>
</section>

<!-- breadcrumb-end -->

<!-- about section -->
<!-- <section class="about-area pt-130 pb-20">
    <div class="container">
        <div class="row">

            
            <div class="col-xl-6 col-lg-5 mb-60">
                <div class="tp-about-thumb about-image-wrapper wow fadeInLeft" data-wow-delay=".2s">
                    @php
                        $img = $about->image ? asset('storage/'.$about->image) : asset('assets/img/about/default-about.jpg');
                    @endphp
                    <img src="{{ $img }}" alt="About">
                </div>
            </div>

            
            <div class="col-xl-6 col-lg-7 mb-60">
                <div class="about-content wow fadeInRight" data-wow-delay=".2s">
                    <div class="tp-section">

                        <h3 class="tp-section__title mb-25">
                            {{ $about->title }}
                        </h3>

                        <p class="mb-40">
                            {!! \Illuminate\Support\Str::words(strip_tags($about->content ?? ''), 60, '...') !!}
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section> -->
<!-- about section end -->

<!-- details section -->
<section class="services-details pt-20 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tp-srv-process mb-50">
                    <h3 class="tp-section__title mb-25">
                            {{ $about->title }}
                        </h3>
                    <p class="mb-20">
                        {!! $about->content !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TABS SECTION -->
<section class="nav-area tp-common-area pt-50 pb-80">
    <div class="container">

        <!-- tabs -->
        <ul class="nav tp-nav-tavs mb-70" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active"
                        id="why-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#why"
                        type="button" role="tab">
                    Why Choose Us
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="mission-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#mission"
                        type="button" role="tab">
                    Our Mission
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="vision-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#vision"
                        type="button" role="tab">
                    Our Vision
                </button>
            </li>
        </ul>

        <!-- tab content -->
        <div class="tab-content">

            <!-- Why Choose Us -->
            <div class="tab-pane fade show active" id="why" role="tabpanel">
                <span class="nav-info d-flex justify-content-center text-center mb-50">
                    {!! $about->why_choose_us !!}
                </span>
            </div>

            <!-- Mission -->
            <div class="tab-pane fade" id="mission" role="tabpanel">
                <span class="nav-info d-flex justify-content-center text-center mb-50">
                    {!! $about->mission !!}
                </span>
            </div>

            <!-- Vision -->
            <div class="tab-pane fade" id="vision" role="tabpanel">
                <span class="nav-info d-flex justify-content-center text-center mb-50">
                    {!! $about->vision !!}
                </span>
            </div>

        </div>
    </div>
</section>

@endsection
