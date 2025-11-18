@extends('layouts.frontend')

{{-- Home SEO --}}
@section('meta_title', 'Anatech Zambia | Laboratory Equipment, Scientific Instruments & Industrial Supplies')

@section('meta_description', 'Anatech supplies high-quality laboratory equipment, scientific instruments, chemicals, consumables, calibration tools, and industrial solutions for Food & Beverage, Pharmaceuticals, Environmental Research, Mining, Manufacturing and Academic Institutions across Zambia and Southern Africa.')

@section('meta_keywords', 'Anatech Zambia, laboratory equipment Zambia, scientific instruments, lab chemicals, reagents, consumables, calibration equipment, industrial supplies, food beverage labs, pharmaceutical lab equipment, mining lab instruments')

{{-- Open Graph / Twitter --}}
@section('og_type', 'website')
@section('og_image', asset('assets/img/og-default.jpg'))  {{-- Replace when hero is ready --}}
@section('canonical', url('/'))

@push('meta')
    <meta property="og:locale" content="en_ZM">
    <meta property="article:section" content="Home">
@endpush


@section('content')

<!-- slider-area -->
<section class="slider-area slider-tp-top pt-20 p-relative">
   {{-- Social & Navigation --}}
   <div class="slider-social">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-md-10 d-none d-md-block">
               <div class="slider-content__social">
                  @if(!empty($globalFooter?->facebook))
                     <a class="facebook-2" href="{{ $globalFooter->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i>Facebook</a>
                  @endif
                  @if(!empty($globalFooter?->youtube))
                     <a class="youtub-2" href="{{ $globalFooter->youtube }}" target="_blank"><i class="fab fa-youtube"></i>Youtube</a>
                  @endif
                  @if(!empty($globalFooter?->twitter))
                     <a class="twitter-2" href="{{ $globalFooter->twitter }}" target="_blank"><i class="fab fa-twitter"></i>Twitter</a>
                  @endif
                  @if(!empty($globalFooter?->linkedin))
                     <a class="linkedin-2" href="{{ $globalFooter->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i>LinkedIn</a>
                  @endif
               </div>
            </div>
            <div class="col-lg-6 col-md-2 col-12 d-none d-md-block">
               <div class="slider-content__arrow d-flex align-items-center">
                  <div class="slider-p"><i class="fa-regular fa-arrow-left"></i></div>
                  <div class="slider-n"><i class="fa-regular fa-arrow-right"></i></div>
               </div>
            </div>
         </div>
      </div>
   </div>

   {{-- Swiper Slider --}}
   <div class="swiper-container tp-slider slider-active">
    <div class="swiper-wrapper">

        {{-- Static Default Slide (Anatech version) --}}
        <div class="swiper-slide bg-white">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-md-12 col-12 order-2 order-lg-1">
                        <div class="slider-content pt-60">

                            <h2 class="slider-content__title mb-20">
                                Advanced Laboratory & Analytical Solutions You Can Trust
                            </h2>

                            <p>
                                Anatech supplies high-quality laboratory equipment, scientific instruments,
                                chemicals, and consumables — empowering accurate testing, research, and
                                industrial quality assurance across Zambia and the region.
                            </p>

                            <div class="slider-content__btn mb-165">
                                <a class="tp-btn" href="{{ url('/contact-us') }}">Contact Us</a>
                                <a class="tp-btn-second ml-25" href="{{ url('/about-us') }}">About Us</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 order-1 order-lg-2">
                        <div class="slider-content__bg image-wrapper">
                            <img src="{{ asset('assets/img/slider/slider-bg-1.jpg') }}" alt="Anatech Laboratory Equipment">
                        </div>

                        <!-- <div class="slider-content__shape d-none d-md-block">
                            <img src="{{ asset('assets/img/slider/slider-bg-2.png') }}" alt="slider-shape">
                        </div> -->
                    </div>

                </div>
            </div>
        </div>


        {{-- Dynamic Slide (from Database) --}}
        @if(!empty($hero))
            <div class="swiper-slide bg-white">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-6 col-md-12 col-12 order-2 order-lg-1">
                            <div class="slider-content pt-60">

                                <h2 class="slider-content__title mb-20">
                                    {{ $hero->title ?? 'Quality Laboratory Solutions for Every Industry' }}
                                </h2>

                                <p>
                                    {{ $hero->subtitle ?? 'Empowering science, research and industrial accuracy through reliable equipment and consumables.' }}
                                </p>

                                <div class="slider-content__btn mb-165">
                                    <a class="tp-btn" href="{{ url('/contact-us') }}">
                                        Learn More
                                    </a>

                                    <a class="tp-btn-second ml-25" href="{{ url('/services') }}">
                                        Our Services
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 order-1 order-lg-2">
                            <div class="slider-content__bg image-wrapper">
                                <img src="{{ asset('storage/' . $hero->background_image) }}"
                                     alt="{{ $hero->title ?? 'Hero Image' }}">
                            </div>
<!-- 
                            <div class="slider-content__shape d-none d-md-block">
                                <img src="{{ asset('assets/img/slider/slider-bg-2.png') }}" alt="slider-shape">
                            </div> -->
                        </div>

                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

</section>
<!-- slider-area-end -->


{{-- End Hero --}}


{{-- About --}}
@if(!empty($about))
<!-- about-area -->
<section class="about-area grey-bg pt-130 tp-box-space pb-130 ml-30 mr-30"
         data-background="{{ asset('assets/img/shape/shape-bg-05.png') }}">
   <div class="about-wrapper">
      <div class="container">
         <div class="row">
            {{-- About Image & Video --}}
            <div class="col-xl-6 col-lg-12 col-12">
               <div class="about-thumb p-relative about-image-wrapper wow fadeInLeft" data-wow-delay=".3s">
                  <img src="{{ $about->image ? asset('storage/'.$about->image) : asset('assets/img/about/about-bg-02.png') }}"
                        alt="{{ $about->title ?? 'About Image' }}">

                  @if(!empty($about->video_link))
                        <div class="about-video">
                           <a class="popup-video" href="{{ $about->video_link }}">
                              <i class="fa-solid fa-play"></i>
                           </a>
                        </div>
                  @endif
               </div>
            </div>


            {{-- About Text --}}
            <div class="col-xl-6 col-lg-12 col-12">
               <div class="about-content ml-60 mb-60 wow fadeInRight" data-wow-delay=".3s">
                  <div class="tp-section">
                     <span class="tp-section__sub-title left-line mb-25">About Us</span>
                     <h3 class="tp-section__title mb-45">
                        {{ $about->title ?? 'Get Ready for Success' }}
                     </h3>

                     <!-- @if(!empty($about->mission))
                        <i>{{ $about->mission }}</i>
                     @else
                        <i>Your trusted partner in sanitation, waste management, and sustainable environmental solutions.</i>
                     @endif -->

                     <p class="mr-20 mb-35">
                        {!! \Illuminate\Support\Str::words(strip_tags($about->content ?? ''), 60, '...') !!}
                     </p>
                  </div>

                  <div class="about-content__btn">
                     <a href="{{ url('/about-us') }}" class="tp-btn">More</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   {{-- CTA Section --}}
   <!-- <div class="cta-area pt-75">
      <div class="container">
         <div class="row wow fadeInUp" data-wow-delay=".3s">
            <div class="col-lg-12">
               <div class="tp-cta-bg p-relative theme-light-bg pt-65 pb-70"
                    data-background="{{ asset('assets/img/shape/shape-bg-04.png') }}">
                  <div class="cta-content ml-90">
                     <div class="tp-section">
                        <span class="tp-section__sub-title sub-title-white left-line-white mb-20">
                           Book Free Sampling
                        </span>
                     </div>
                     <h2 class="cta-title mb-30">
                        Free Sampling at your <br> Home Address
                     </h2>
                     <div class="cta-btn">
                        <a href="{{ url('/contact-us') }}" class="tp-btn-second">Book Now</a>
                     </div>
                     <div class="cta-shape d-none d-md-block">
                        <img src="{{ asset('assets/img/shape/logo-shape-1.png') }}" alt="cta-logo-shape">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->
</section>
<!-- about-area-end -->
@endif

{{-- End About --}}

{{-- Services --}}
@if(!empty($featuredServices) && count($featuredServices))
<!-- services-area -->
<section class="services-area pt-120 pb-75">
   <div class="container">

      {{-- Section Heading --}}
      <div class="row align-items-end mb-45">
         <div class="col-lg-5 col-md-12 col-12">
            <div class="tp-section">
               <span class="tp-section__sub-title left-line mb-20">Our Services</span>
               <h3 class="tp-section__title mb-30">Service Areas</h3>
            </div>
         </div>
         <div class="col-lg-7 col-md-12 col-12">
            <div class="services-link text-md-start text-lg-end mb-30">
               <span>
                  We'll ensure you always get the best results:
                  <a href="{{ url('/services') }}">
                     More Services <i class="fa-solid fa-arrow-right"></i>
                  </a>
               </span>
            </div>
         </div>
      </div>

      {{-- Services Grid --}}
      <div class="row">
         @foreach($featuredServices as $index => $service)
            @php
               // Animation delay
               $delay = number_format(0.2 + ($index % 4) * 0.2, 1);
            @endphp

            <div class="col-xl-3 col-lg-4 col-md-6">
               <div class="services-item tp-services-item mb-50 wow fadeInUp"
                    data-wow-delay=".{{ str_replace('.', '', $delay) }}s">

                  <div class="services-item__icon mb-30">
                     @if(!empty($service->icon))
                        <img src="{{ asset('storage/' . $service->icon) }}"
                             alt="{{ $service->title }}" width="40" height="40">
                     @else
                        <i class="flaticon-bacteria"></i>
                     @endif
                  </div>

                  <div class="services-item__content">
                     <h5 class="services-item__tp-title mb-20">
                        <a href="{{ route('services.show', $service->slug) }}">
                           {{ $service->title }}
                        </a>
                     </h5>

                     <p>{{ Str::limit(strip_tags($service->description), 100) }}</p>
                  </div>

               </div>
            </div>

         @endforeach
      </div>

   </div>
</section>

@endif

{{-- End Services --}}

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

<!-- brand-area -->
         <div class="brand-area pt-170 pb-120">
            <div class="container">
               <div class="brand-border pt-60 pb-60">
                  <div class="swiper-container brand-active">
                     <div class="swiper-wrapper brand-items">
                        <div class="swiper-slide">
                           <a href="#"><img src="assets/img/brand/brand-01.png" alt="brand"></a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#"><img src="assets/img/brand/brand-02.png" alt="brand"></a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#"><img src="assets/img/brand/brand-03.png" alt="brand"></a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#"><img src="assets/img/brand/brand-04.png" alt="brand"></a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#"><img src="assets/img/brand/brand-05.png" alt="brand"></a>
                        </div>
                        <div class="swiper-slide">
                           <a href="#"><img src="assets/img/brand/brand-04.png" alt="brand"></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- brand-area-end -->     
<!-- {{-- Products --}}
<section class="cs_pb_135 cs_pb_lg_75">
  <div class="container">
    <div class="cs_section_heading cs_style_1 d-flex align-items-center cs_mb_60 cs_mb_lg_40 cs_column_gap_15 cs_row_gap_15">
      <div class="cs_section_heading_in">
        <h3 class="cs_fs_20 cs_fs_lg_18 text-accent fw-normal cs_lh_base cs_mb_10">Mobile Toilets & Sanitation Solutions</h3>
        <h2 class="cs_fs_48 cs_fs_lg_36 m-0">Sanitation Solutions</h2>
      </div>
      <div class="cs_section_heading_right">
        <div class="text-end">
          <a href="{{ url('/products') }}" class="cs_btn cs_style_1 cs_fs_16 cs_rounded_5 cs_pl_30 cs_pr_30 cs_pt_10 cs_pb_10 overflow-hidden"><span>View More</span></a>
        </div>
      </div>
    </div>

    <div class="cs_product_slider cs_gap_24">
      <div class="cs_slider_activate">
        @forelse($featuredProducts as $product)
          <div class="cs_slide">
            <div class="cs_product_card cs_style_1">
              <div class="cs_product_thumb">
                <img 
                  src="{{ $product->image ? asset('storage/'.$product->image) : asset('assets/img/product_default.jpeg') }}"
                  alt="{{ $product->title ?? $product->name ?? 'Product' }}"
                  style="width:100%; height:250px; object-fit:cover; border-radius:8px;"
                >

                <div class="cs_product_overlay"></div>
                <div class="cs_card_btns">
                  <a href="{{ route('products.show', $product->slug) }}"><i class="fa-solid fa-link" aria-hidden="true"></i></a>
                </div>
              </div>
              <div class="cs_product_info">
                <h2 class="cs_product_title">
                  <a href="{{ route('products.show', $product->slug) }}">
                    {{ $product->title ?? $product->name ?? 'Untitled Product' }}
                  </a>
                </h2>
                <p class="cs_product_price">
                  @php $price = $product->price ?? null; @endphp
                  Price: {{ $price !== null ? ('$'.number_format((float)$price, 2)) : 'Contact' }}
                </p>
              </div>
            </div>
          </div>
        @empty
          <div class="cs_slide">
            <div class="cs_product_card cs_style_1">
              <div class="cs_product_info p-4">
                <h2 class="cs_product_title m-0">No featured products yet.</h2>
              </div>
            </div>
          </div>
        @endforelse
      </div>
    </div>

  </div>
</section>
{{-- End Products --}} -->

@if(!empty($testimonials) && count($testimonials))
<!-- testimonial-area -->
<div class="testimonial-area pt-130 pb-125 testi-bg theme-light-bg"
     data-background="{{ asset('assets/img/shape/shape-bg-05.png') }}">
   <div class="container p-relative wow fadeInUp" data-wow-delay=".3s">

      {{-- Avatar Slider --}}
      <div class="row justify-content-center">
         <div class="col-lg-4 col-md-6">
            <div class="testi-thumb text-center">
               <div class="swiper-container swiper test-ava-active">
                  <div class="swiper-wrapper testi-avta-bottom pb-70">
                     @foreach($testimonials as $t)
                        <div class="swiper-slide">
                           <img src="{{ $t->author_photo ? asset('storage/'.$t->author_photo) : asset('assets/img/avatar_default.png') }}"
                                alt="{{ $t->author_name }}" width="80" height="80">
                        </div>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>

         {{-- Slider Arrows --}}
         <div class="testi-arrow">
            <div class="testi-button-next"><i class="fa-regular fa-arrow-right"></i></div>
            <div class="testi-button-prev"><i class="fa-regular fa-arrow-left"></i></div>
         </div>
      </div>

      {{-- Testimonial Text Slider --}}
      <div class="row justify-content-center">
         <div class="col-xl-9 col-lg-10 col-md-11 col-12">
            <div class="swiper-container swiper test-active">
               <div class="swiper-wrapper">
                  @foreach($testimonials as $t)
                     <div class="swiper-slide">
                        <div class="testi-content text-center">
                           <p>
                              “{{ \Illuminate\Support\Str::limit(strip_tags($t->content), 250) }}”
                           </p>
                           <i>{{ $t->author_name }}</i>
                           @if(!empty($t->author_position))
                              <span>{{ $t->author_position }}</span>
                           @endif
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>

   </div>
</div>
<!-- testimonial-area-end -->
@else
<!-- testimonial-area -->
<div class="testimonial-area pt-130 pb-125 testi-bg theme-light-bg text-center"
     data-background="{{ asset('assets/img/shape/shape-bg-05.png') }}">
   <div class="container">
      <p class="m-0">No testimonials yet. Check back soon.</p>
   </div>
</div>
@endif


{{-- Blog --}}
@if(!empty($recentBlogs) && count($recentBlogs))
<!-- blog-area -->
<section class="blog-area pt-125 pb-120">
   <div class="container wow fadeInUp" data-wow-delay=".3s">

      {{-- Section Heading --}}
      <div class="row align-items-center">
         <div class="col-md-8 col-12">
            <div class="tp-section">
               <span class="tp-section__sub-title left-line mb-25">What’s New</span>
               <h3 class="tp-section__title mb-65">Blog & Articles</h3>
            </div>
         </div>
         <div class="col-md-4 col-12">
            <div class="blog-arrow d-flex align-items-center justify-content-md-end">
               <div class="blog-prv"><i class="fa-regular fa-arrow-left"></i></div>
               <div class="blog-nxt"><i class="fa-regular fa-arrow-right"></i></div>
            </div>
         </div>
      </div>

      {{-- Blog Slider --}}
      <div class="swiper-container blog-active">
         <div class="swiper-wrapper">
            @foreach($recentBlogs as $blog)
               <div class="swiper-slide pb-50">
                  <div class="blog-item">
                     {{-- Thumbnail --}}
                     <div class="blog-item__thumb fix">
                        <a href="{{ route('blogs.show', $blog->slug) }}">
                           <img src="{{ $blog->featured_image 
                              ? asset('storage/'.$blog->featured_image) 
                              : asset('assets/img/blog/blog-thumb-04.jpg') }}" 
                              alt="{{ $blog->title }}">
                        </a>
                     </div>

                     {{-- Content --}}
                     <div class="blog-item__content">
                        <h5 class="blog-item__title mb-15">
                           <a href="{{ route('blogs.show', $blog->slug) }}">
                              {{ $blog->title }}
                           </a>
                        </h5>

                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->excerpt ?? $blog->content), 120) }}</p>

                        <div class="blog-item__date-info">
                           <ul class="d-flex align-items-center">
                              <li>
                                 <i class="fa-light fa-clock"></i>
                                 {{ $blog->created_at->format('M d, Y') }}
                              </li>
                              <li>
                                 <i class="fa-light fa-eye"></i>
                                 {{ $blog->views ?? '1,000+' }} views
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </div>

      {{-- Bottom Link --}}
      <div class="row mt-4">
         <div class="col-lg-12">
            <div class="blog-link text-center">
               <span>
                  Join our community for updates: 
                  <a href="{{ url('/blogs') }}">
                     Join Now <i class="fa-regular fa-arrow-right"></i>
                  </a>
               </span>
            </div>
         </div>
      </div>

   </div>
</section>
<!-- blog-area-end -->
@else
<!-- blog-area -->
<section class="blog-area pt-125 pb-120 text-center">
   <div class="container">
      <p class="m-0">No blog articles yet. Check back soon.</p>
   </div>
</section>
@endif

{{-- End Blog --}}


<!-- newsletter-area -->
<section class="news-letter-area pt-110 pb-110 news-round-shape p-relative tp-box-space mr-30 ml-30 theme-light-bg fix"
         data-background="{{ asset('assets/img/shape/shape-bg-05.png') }}">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xl-6 col-lg-8 col-md-10 col-12">
            <div class="newsletter-content text-center">
               <h3 class="newsletter-title mb-15">Newsletter</h3>
               <span>#Subscribe to our newsletter for updates and offers</span>

               {{-- Newsletter Form --}}
               <div class="newsletter-form p-relative ml-10 mr-10 mt-30">
                  <form action="{{ route('newsletter.subscribe') }}" method="POST">
                     @csrf
                     <input type="email"
                            name="email"
                            required
                            class="form-control text-center @error('email') is-invalid @enderror"
                            placeholder="Enter your email address"
                            value="{{ old('email') }}">
                     <button type="submit" class="newsletter-btn">
                        Subscribe <i class="fa-solid fa-paper-plane"></i>
                     </button>

                     {{-- Validation Errors & Success Messages --}}
                     @error('email')
                        <div class="invalid-feedback d-block mt-2 text-danger">
                           {{ $message }}
                        </div>
                     @enderror
                     @if(session('success'))
                        <div class="alert alert-success mt-3 py-2 px-3">
                           {{ session('success') }}
                        </div>
                     @endif
                     @if(session('error'))
                        <div class="alert alert-danger mt-3 py-2 px-3">
                           {{ session('error') }}
                        </div>
                     @endif
                  </form>
               </div>

            </div>
         </div>
      </div>
   </div>
</section>
<!-- newsletter-area-end -->

@endsection
