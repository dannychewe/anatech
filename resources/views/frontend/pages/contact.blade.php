@extends('layouts.frontend')

{{-- ====================================================== --}}
{{-- CONTACT PAGE SEO — ANATECH ZAMBIA                     --}}
{{-- ====================================================== --}}

@section('meta_title', 'Contact Anatech Zambia | Laboratory & Industrial Equipment Supplier')
@section('meta_description', 'Get in touch with Anatech for laboratory equipment, scientific instruments, chemicals, consumables, calibration services, and technical support across Zambia.')
@section('meta_keywords', 'contact Anatech, laboratory equipment Zambia, scientific instruments, calibration services, lab supplier Zambia')

@php
    $canonical = url('/contact-us');
    $image     = asset('assets/img/og-default.jpg'); 
    $orgName   = 'Anatech Zambia';
    $logo      = asset('assets/img/logo/logo.png');

    $phone     = optional($globalFooter)->phone ?? '+260 000 000 000';
    $email     = optional($globalFooter)->email ?? 'info@anatech.co.zm';
    $address   = optional($globalFooter)->address ?? 'Lusaka, Zambia';

    $sameAs = array_values(array_filter([
        optional($globalFooter)->facebook,
        optional($globalFooter)->linkedin,
        optional($globalFooter)->instagram,
        optional($globalFooter)->twitter,
        optional($globalFooter)->youtube,
    ]));
@endphp

{{-- Canonical + OG --}}
@section('canonical', $canonical)
@section('og_type', 'website')
@section('og_image', $image)

{{-- ====================================================== --}}
{{-- STRUCTURED DATA: ContactPage & Breadcrumbs             --}}
{{-- ====================================================== --}}
@push('structured_data')
    {{-- Contact Page JSON-LD --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context'        => 'https://schema.org',
        '@type'           => 'ContactPage',
        'name'            => 'Contact Anatech Zambia',
        'url'             => $canonical,
        'primaryImageOfPage' => $image,

        'mainEntity' => [
            '@type' => 'Organization',
            'name'  => $orgName,
            'url'   => url('/'),
            'logo'  => $logo,
            'description' => 'Supplier of laboratory equipment, scientific instruments, chemicals, reagents, consumables, and calibration services across Zambia.',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $address,
                'addressCountry'=> 'ZM',
            ],
            'sameAs' => $sameAs,

            'contactPoint' => [[
                '@type' => 'ContactPoint',
                'contactType' => 'Customer Support',
                'telephone'   => $phone,
                'email'       => $email,
                'areaServed'  => ['ZM'],
            ]],
        ],
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>

    {{-- Breadcrumbs JSON-LD --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => url('/')
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Contact Anatech',
                'item' => $canonical
            ],
        ],
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush


@section('content')

<!-- breadcrumb-area -->
<section class="breadcrumb__area pt-100 pb-120 breadcrumb__overlay"
         data-background="{{ asset('assets/img/banner/breadcrumb-01.jpg') }}">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-md-7">
                <div class="tp-breadcrumb">
                    <h2 class="tp-breadcrumb__title">Contact Us</h2>
                </div>
            </div>

            <div class="col-lg-6 col-md-5">
                <div class="tp-breadcrumb__link d-flex justify-content-md-end align-items-center">
                    <span>Home : <a href="{{ url('/') }}"> Contact</a></span>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- breadcrumb-area-end -->



<!-- contact-area -->
<section class="contact-area pt-130 pb-115">
    <div class="container">
        <div class="row">

            <!-- LEFT SIDE: Contact Info -->
            <div class="col-lg-4 col-md-5 col-12 wow fadeInLeft" data-wow-delay=".4s">

    {{-- Address --}}
    <div class="tpcontact mr-60 mb-60 wow fadeInUp" data-wow-delay=".2s">
        <div class="tpcontact__item text-center">
            <div class="tpcontact__icon mb-20">
                <img src="{{ asset('assets/img/icon/contact-01.svg') }}" alt="Address Icon">
            </div>
            <div class="tpcontact__address">
                <h4 class="tpcontact__title mb-15">Address</h4>
                <span>{{ optional($globalFooter)->address ?? 'Johannesburg, South Africa' }}</span>
            </div>
        </div>
    </div>

    {{-- Phone --}}
    <div class="tpcontact mr-60 mb-60 wow fadeInUp" data-wow-delay=".4s">
        <div class="tpcontact__item text-center">
            <div class="tpcontact__icon mb-20">
                <img src="{{ asset('assets/img/icon/contact-02.svg') }}" alt="Phone Icon">
            </div>
            <div class="tpcontact__address">
                <h4 class="tpcontact__title mb-15">Phone</h4>
                <span>
                    <a href="tel:{{ optional($globalFooter)->phone }}">
                        {{ optional($globalFooter)->phone ?? '+27 000 000 000' }}
                    </a>
                </span>
            </div>
        </div>
    </div>

    {{-- Email --}}
    <div class="tpcontact mr-60 mb-60 wow fadeInUp" data-wow-delay=".6s">
        <div class="tpcontact__item text-center">
            <div class="tpcontact__icon mb-20">
                <img src="{{ asset('assets/img/icon/contact-03.svg') }}" alt="Email Icon">
            </div>
            <div class="tpcontact__address">
                <h4 class="tpcontact__title mb-15">Email</h4>
                <span>
                    <a href="mailto:{{ optional($globalFooter)->email }}">
                        {{ optional($globalFooter)->email ?? 'info@example.com' }}
                    </a>
                </span>
            </div>
        </div>
    </div>

</div>





            <!-- RIGHT SIDE: Contact Form -->
            <div class="col-lg-8 col-md-7">
                <div class="contactform mb-60">

                    <h4 class="contactform__title mb-35">Send us a Message</h4>

                    {{-- Flash messages --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif


                    <form action="{{ route('contact.submit') }}" method="POST" class="contactform__list">
                        @csrf

                        <div class="row">

                            {{-- Name --}}
                            <div class="col-lg-6">
                                <div class="contactform__input mb-30">
                                    <input type="text" name="name" placeholder="Your Name"
                                           value="{{ old('name') }}" required>
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-lg-6">
                                <div class="contactform__input mb-30">
                                    <input type="email" name="email" placeholder="Email Address"
                                           value="{{ old('email') }}" required>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="col-lg-6">
                                <div class="contactform__input mb-30">
                                    <input type="text" name="phone" placeholder="Phone (optional)"
                                           value="{{ old('phone') }}">
                                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Subject --}}
                            <div class="col-lg-6">
                                <div class="contactform__input mb-30">
                                    <input type="text" name="subject" placeholder="Subject"
                                           value="{{ old('subject') }}">
                                    @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Message --}}
                            <div class="col-lg-12">
                                <div class="contactform__input mb-30">
                                    <textarea name="message" placeholder="Write your message..." required>{{ old('message') }}</textarea>
                                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            {{-- Anti-bot honeypot --}}
                            <input name="website" type="text" style="display:none">

                            {{-- Submit --}}
                            <div class="col-lg-12">
                                <div class="contactform__input mb-30-btn">
                                    <button type="submit" class="tp-btn">Send Message</button>
                                </div>
                            </div>

                        </div>
                    </form>


                   

                </div>
                <div class="row">
                           <div class="col-lg-12">
                              <div class="tpcontactmap">
                                 
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3846.7623828895894!2d28.3133031!3d-15.3893499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19408b466743afe5%3A0x9f2942068b68a3b3!2sMulungushi%20International%20Conference%20Centre!5e0!3m2!1sen!2szm!4v1763458937150!5m2!1sen!2szm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                              </div>
                           </div>
                        </div>
            </div>

        </div>
    </div>
</section>
<!-- contact-area-end -->

@endsection
