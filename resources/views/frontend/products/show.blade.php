{{-- resources/views/frontend/products/show.blade.php --}}
@extends('layouts.frontend')

@php
  // Product featured image
  $img = $product->image
      ? asset('storage/'.$product->image)
      : asset('assets/img/product_default.jpeg');

  // Clean canonical URL (no query strings)
  $canonical = route('products.show', $product->slug);

  // Default currency for Zambia
  $currency = 'ZMW';

  // 155-160 chars SEO summary
  $shortDesc = $product->meta_description
      ?? \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 155);

  $galleryImages = collect([$img])
      ->merge($product->images->map(fn ($image) => asset('storage/'.$image->path)))
      ->filter()
      ->unique()
      ->values();
@endphp


{{-- ========================================================= --}}
{{-- META TAGS (SEO, OG, TWITTER)                             --}}
{{-- ========================================================= --}}
@section('meta_title', $product->meta_title ?? $product->name)
@section('meta_description', $shortDesc)
@section('meta_keywords', $product->meta_keywords ?? 'laboratory equipment zambia, scientific instruments, chemicals, reagents, industrial supplies, anatech products')
@section('canonical', $canonical)

@section('og_type', 'product')
@section('og_image', $img)



{{-- ========================================================= --}}
{{-- STRUCTURED DATA (JSON-LD)                                --}}
{{-- ========================================================= --}}
@push('structured_data')
@php
  // Build Product Schema
  $productLd = [
    '@context'    => 'https://schema.org',
    '@type'       => 'Product',
    'name'        => $product->name,
    'description' => trim(\Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 500)),
    'image'       => [$img],
    'url'         => $canonical,
    'brand'       => [
        '@type' => 'Brand',
        'name'  => 'Anatech Zambia'
    ],
  ];

  // Add SKU only if exists
  if (!empty($product->sku)) {
    $productLd['sku'] = $product->sku;
  }

  // Price + offer information
  if (!empty($product->price)) {
    $productLd['offers'] = [
      '@type'           => 'Offer',
      'priceCurrency'   => $currency,
      'price'           => number_format((float) $product->price, 2, '.', ''),
      'availability'    => 'https://schema.org/InStock',
      'url'             => $canonical,
      'itemCondition'   => 'https://schema.org/NewCondition',
    ];
  }

  // Breadcrumbs Schema
  $breadcrumbs = [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      [
        '@type'    => 'ListItem',
        'position' => 1,
        'name'     => 'Home',
        'item'     => url('/')
      ],
      [
        '@type'    => 'ListItem',
        'position' => 2,
        'name'     => 'Products',
        'item'     => route('products.index')
      ],
      [
        '@type'    => 'ListItem',
        'position' => 3,
        'name'     => $product->name,
        'item'     => $canonical
      ],
    ],
  ];
@endphp

<script type="application/ld+json">
{!! json_encode($productLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush



{{-- ========================================================= --}}
{{-- PAGE CONTENT                                             --}}
{{-- ========================================================= --}}
@section('content')


<!-- breadcrumb-area -->
<section class="breadcrumb__area pt-100 pb-120 breadcrumb__overlay" 
         data-background="{{ $product->image ? asset('storage/'.$product->image) : asset('assets/img/banner/breadcrumb-01.jpg') }}">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-xl-7 col-lg-12 col-md-12 col-12">
                <div class="tp-breadcrumb">
                    <h2 class="tp-breadcrumb__title">{{ $product->name }}</h2>
                </div>
            </div>

            

        </div>
    </div>
</section>
<!-- breadcrumb-area-end -->


<!-- shop-details-area -->
<section class="shop-area pt-120 pb-70">
    <div class="container">
        <div class="shop-left-right ml-130 mr-130">

            <div class="row gx-5 gy-5 align-items-center">

                {{-- LEFT: PRODUCT IMAGE --}}
                <div class="col-lg-6 col-md-6">
                    <div class="productthumb mb-40 wow fadeInLeft product-detail-card--alt" data-wow-delay=".4s">
                        <div class="product-gallery">
                            <div class="product-gallery__main">
                                <img
                                    id="product-main-image"
                                    src="{{ $galleryImages->first() }}"
                                    alt="{{ $product->name }}">
                            </div>
                            @if($galleryImages->count() > 1)
                                <div class="product-gallery__thumbs">
                                    @foreach($galleryImages as $key => $source)
                                        <button type="button"
                                                class="product-gallery__thumb {{ $key === 0 ? 'active' : '' }}"
                                                data-image="{{ $source }}"
                                                aria-label="Preview {{ $key + 1 }}">
                                            <img src="{{ $source }}" alt="{{ $product->name }} thumbnail {{ $key + 1 }}">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- RIGHT: PRODUCT DETAILS --}}
                <div class="col-lg-6 col-md-6">
                    <div class="product-detail-card wow fadeInRight" data-wow-delay=".4s">
                        <span class="product-detail-card__badge">
                            {{ optional($product->category)->name ?? 'Featured Product' }}
                        </span>
                        <h3 class="product-detail-card__title">{{ $product->name }}</h3>
                        <div class="product-detail-card__meta">
                            <span>
                                Price:
                                @if($product->price)
                                    ZMW {{ number_format($product->price, 2) }}
                                @else
                                    On request
                                @endif
                            </span>
                            <span>SKU: {{ $product->sku ?? '—' }}</span>
                        </div>
                        <div class="product-detail-card__actions">
                            <a href="#order-section" class="tp-btn">Enquiry</a>
                            <a href="{{ url('/contact-us') }}" class="tp-btn-second">Contact Anatech</a>
                        </div>
                        <p class="product-detail-card__summary">
                            {{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 220) }}
                        </p>
                    </div>
                </div>

            </div>

            {{-- PRODUCT DESCRIPTION TABS --}}
            <div class="productdetails pt-35 pb-75">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="product-additional-tab">

                            <div class="pro-details-nav mb-40">
                                <ul class="nav nav-tabs pro-details-nav-btn" id="myTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-links active" id="home-tab-1" data-bs-toggle="tab" 
                                                data-bs-target="#home-1" type="button" role="tab">
                                            Product Details
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content tp-content-tab" id="myTabContent-2">
                                <div class="tab-para tab-pane fade show active" id="home-1" role="tabpanel">

                                    {!! $product->description !!}

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            {{-- ORDER SECTION IF FEATURED --}}
            @if($product->is_featured)
                <div id="order-section" class="pt-50 pb-50">
                    <h3>Order This Product</h3>

                    <form action="{{ route('frontend.booking.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Your Name</label>
                                <input type="text" name="customer_name" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email Address</label>
                                <input type="email" name="customer_email" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Phone</label>
                                <input type="text" name="customer_phone" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Location</label>
                                <input type="text" name="location" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Quantity</label>
                                <input type="number" name="quantity" class="form-control" value="1" min="1">
                            </div>

                            <div class="col-12 mb-3">
                                <label>Notes</label>
                                <textarea name="notes" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="col-12">
                                <button class="tp-btn">Submit Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

        </div>
    </div>
</section>
<!-- shop-details-area-end -->
@include('frontend.partials.product-card-styles')

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const mainImage = document.getElementById('product-main-image');
    if (!mainImage) return;
    const thumbs = document.querySelectorAll('.product-gallery__thumb');
    thumbs.forEach((thumb) => {
        thumb.addEventListener('click', function () {
            const src = this.dataset.image;
            if (!src) return;
            mainImage.src = src;
            thumbs.forEach((btn) => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
@endpush

@endsection
