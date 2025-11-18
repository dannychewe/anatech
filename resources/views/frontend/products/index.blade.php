@extends('layouts.frontend')

@php
  // Canonical: keep q/sort but omit ?page=1 for SEO cleanliness
  $page  = (int) request('page', 1);
  $query = request()->except(['page']);
  $qs    = http_build_query($query);
  $base  = url()->current();

  $canonical = $page > 1
      ? ($qs ? $base.'?'.$qs.'&page='.$page : request()->fullUrl())
      : ($qs ? $base.'?'.$qs : $base);

  // Default OG/social image for product listing
  $listingImage = asset('assets/img/og-default.jpg');
@endphp


{{-- ===================================================== --}}
{{-- PAGE META (ANATECH)                                   --}}
{{-- ===================================================== --}}
@section('meta_title', 'Products | Anatech Zambia – Laboratory & Industrial Equipment')
@section('meta_description', 'Browse high-quality laboratory equipment, scientific instruments, chemicals, consumables, and industrial supplies from Anatech Zambia.')
@section('meta_keywords', 'Anatech, laboratory equipment Zambia, scientific instruments, lab consumables, industrial supplies, chemicals, reagents, calibration services')
@section('canonical', $canonical)
@section('og_type', 'website')
@section('og_image', $listingImage)



{{-- ===================================================== --}}
{{-- JSON-LD: Product ItemList + Breadcrumbs               --}}
{{-- ===================================================== --}}
@push('structured_data')
@php
  $itemList = [
    '@context'         => 'https://schema.org',
    '@type'            => 'ItemList',
    'name'             => 'Anatech Product Catalogue',
    'itemListOrder'    => 'https://schema.org/ItemListOrderAscending',
    'numberOfItems'    => $products->count(),
    'itemListElement'  => [],
  ];

  $position = $products->firstItem() ?? 1;

  foreach ($products as $p) {
      $img = $p->image
          ? asset('storage/'.$p->image)
          : $listingImage;

      $itemList['itemListElement'][] = [
          '@type'    => 'ListItem',
          'position' => $position++,
          'item'     => [
              '@type'  => 'Product',
              'name'   => $p->name,
              'image'  => [$img],
              'url'    => route('products.show', $p->slug),
              'description' => \Illuminate\Support\Str::limit(strip_tags($p->description ?? ''), 160),
              'offers' => [
                  '@type'         => 'Offer',
                  'price'         => $p->price ?? '0',
                  'priceCurrency' => 'ZMW',
                  'availability'  => 'https://schema.org/InStock',
              ],
          ],
      ];
  }

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
        'name'     => 'Products',
        'item'     => $canonical,
      ],
    ],
  ];
@endphp

<script type="application/ld+json">
{!! json_encode($itemList, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush



{{-- ===================================================== --}}
{{-- MAIN CONTENT                                           --}}
{{-- ===================================================== --}}
@section('content')

<!-- breadcrumb-area -->
<section class="breadcrumb__area pt-100 pb-120 breadcrumb__overlay" 
         data-background="{{ asset('assets/img/banner/breadcrumb-01.jpg') }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-12 col-md-12 col-12">
                <div class="tp-breadcrumb">
                    <h2 class="tp-breadcrumb__title">Our Products</h2>
                </div>
            </div>
            <div class="col-xl-5 col-lg-12 col-md-12 col-12">
                <div class="tp-breadcrumb__link text-xl-end">
                    <span>Anatech : <a href="{{ route('products.index') }}"> Shop</a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb-area-end -->


<!-- shop-area -->
<div class="shop-area pt-120 pb-130">
    <div class="container">

        {{-- Top Filters + Search --}}
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="tpproduct">
                    <span>
                        Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} 
                        of {{ $products->total() }} results
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <form method="GET" class="tpfilter d-flex align-items-center justify-content-end">
                    <span class="me-2">Sort by</span>
                    <select name="sort" onchange="this.form.submit()">
                        <option value="latest" {{ $sort=='latest'?'selected':'' }}>Latest</option>
                        <option value="low" {{ $sort=='low'?'selected':'' }}>Price: low to high</option>
                        <option value="high" {{ $sort=='high'?'selected':'' }}>Price: high to low</option>
                    </select>
                </form>
            </div>
        </div>


        <div class="row">

            @forelse($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="tpshopitem mb-50 wow fadeInUp" data-wow-delay=".2s">

                        {{-- Product Image --}}
                        <div class="tpshopitem__thumb p-relative fix mb-35">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img 
                                    src="{{ $product->image ? asset('storage/'.$product->image) : asset('assets/img/default-product.jpg') }}" 
                                    alt="{{ $product->name }}">
                            </a>
                        </div>

                        {{-- Product Info --}}
                        <div class="tpshopitem__content text-center">
                            <span class="tpshopitem__title mb-5">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </span>

                            @if($product->price)
                                <p>${{ number_format($product->price, 2) }}</p>
                            @else
                                <p class="text-muted">Contact for price</p>
                            @endif
                        </div>

                    </div>
                </div>

            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No products found.</p>
                </div>
            @endforelse

            @if ($products->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="basic-pagination text-center mt-15">
                <nav>
                    <ul class="pagination-list d-flex justify-content-center">

                        {{-- PREVIOUS --}}
                        @if ($products->onFirstPage())
                            <li class="disabled">
                                <span><i class="fa-light fa-arrow-left-long"></i></span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $products->previousPageUrl() }}">
                                    <i class="fa-light fa-arrow-left-long"></i>
                                </a>
                            </li>
                        @endif

                        {{-- PAGE NUMBERS --}}
                        @foreach ($products->links()->elements[0] ?? [] as $page => $url)
                            @if ($page == $products->currentPage())
                                <li><span class="current">{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- NEXT --}}
                        @if ($products->hasMorePages())
                            <li>
                                <a href="{{ $products->nextPageUrl() }}">
                                    <i class="fa-light fa-arrow-right-long"></i>
                                </a>
                            </li>
                        @else
                            <li class="disabled">
                                <span><i class="fa-light fa-arrow-right-long"></i></span>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endif


        </div>


    </div>
</div>
<!-- shop-area-end -->

@endsection
