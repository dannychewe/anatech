@extends('layouts.frontend')

@php
    $heroImage = $category->image ? asset('storage/'.$category->image) : asset('assets/img/banner/breadcrumb-01.jpg');
    $canonical = route('product-categories.show', $category->slug);
    $metaTitle = $category->meta_title ?? ($category->name.' | Anatech Zambia');
    $metaDescription = $category->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($category->description ?? ''), 155);
@endphp

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)
@section('meta_keywords', $category->meta_keywords ?? 'Anatech Zambia, laboratory equipment, scientific instruments, industrial supplies')
@section('canonical', $canonical)
@section('og_type', 'website')
@section('og_image', $heroImage)

@section('content')

    <!-- breadcrumb-area -->
    <section class="breadcrumb__area pt-100 pb-120 breadcrumb__overlay"
             data-background="{{ $heroImage }}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-12 col-md-12 col-12">
                    <div class="tp-breadcrumb">
                        <h2 class="tp-breadcrumb__title">{{ $category->name }}</h2>
                        <p class="text-white opacity-80 mb-0">
                            {{ \Illuminate\Support\Str::limit(strip_tags($category->description ?? 'Discover specialised products backed by local support.'), 120) }}
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->


    <!-- category-products -->
    <section class="category-products pt-120 pb-120">
        <div class="container">

            <div class="row align-items-center mb-40">
                <div class="col-lg-8">
                    <div class="tp-section">
                        <span class="tp-section__sub-title left-line mb-10">Category Showcase</span>
                        <h3 class="tp-section__title">{{ $category->name }}</h3>
                        <p class="text-muted mb-0">
                            {!! nl2br(e($category->description ?? 'Browse premium laboratory equipment & consumables backed by Anatech Zambia.')) !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('products.index') }}" class="tp-btn tp-btn-sm">
                        Browse All Products
                    </a>
                </div>
            </div>

            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <article class="product-card">
                            <div class="product-card__thumb">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('assets/img/product_default.jpeg') }}"
                                         alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="product-card__body">
                                
                                <h4 class="product-card__title">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h4>
                                <p class="product-card__description">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 120) }}
                                </p>
                                <div class="product-card__meta">
                                    <span class="product-card__price">
                                        @if($product->price)
                                            ZMW {{ number_format($product->price, 2) }}
                                        @else
                                            Price on request
                                        @endif
                                    </span>
                                    <span class="text-muted">
                                        SKU: {{ $product->sku ?? '—' }}
                                    </span>
                                </div>
                                <div class="product-card__footer">
                                <span class="text-muted small">
                                    Updated {{ $product->updated_at ? $product->updated_at->diffForHumans() : 'recently' }}
                                </span>
                                    <a href="{{ route('products.show', $product->slug) }}" class="tp-btn tp-btn-sm">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted mb-0">No products in this category yet. Please check back soon.</p>
                    </div>
                @endforelse
            </div>

            @if($products->hasPages())
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="basic-pagination text-center mt-15">
                            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
    <!-- category-products-end -->

    @include('frontend.partials.product-card-styles')

@endsection
