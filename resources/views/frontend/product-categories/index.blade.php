@extends('layouts.frontend')

@php
    $page = (int) request('page', 1);
    $base = url()->current();
    $canonical = $page > 1 ? $base.'?page='.$page : $base;
    $heroImage = asset('assets/img/banner/breadcrumb-01.jpg');
@endphp

@section('meta_title', 'Product Categories | Anatech Zambia')
@section('meta_description', 'Explore Anatech Zambia product categories for laboratory equipment, scientific instruments, consumables, and industrial supplies.')
@section('meta_keywords', 'Anatech, product categories, laboratory equipment, scientific instruments, consumables, industrial supplies')
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
                        <h2 class="tp-breadcrumb__title">Product Categories</h2>
                        <p class="text-white opacity-80 mb-0">
                            Explore curated categories backed by Anatech Zambia's procurement expertise and local support.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->


    <!-- category-list -->
    <section class="product-categories-area pt-120 pb-120">
        <div class="container">

            <div class="row align-items-end mb-50">
                <div class="col-lg-8">
                    <div class="tp-section">
                        <span class="tp-section__sub-title left-line mb-15">Browse Categories</span>
                        <h3 class="tp-section__title">Laboratory & Industrial Solutions</h3>
                        <p class="text-muted mb-0">
                            Find the right equipment, consumables, and solutions for your lab or facility.
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
                @forelse($categories as $category)
                    <div class="col-lg-4 col-md-6">
                        <article class="product-card">
                            <div class="product-card__thumb">
                                <a href="{{ route('product-categories.show', $category->slug) }}">
                                    <img
                                        src="{{ $category->image ? asset('storage/'.$category->image) : asset('assets/img/default-category.jpg') }}"
                                        alt="{{ $category->name }}">
                                </a>
                            </div>
                            <div class="product-card__body">
                                <h4 class="product-card__title">
                                    <a href="{{ route('product-categories.show', $category->slug) }}">
                                        {{ $category->name }}
                                    </a>
                                </h4>
                                <p class="product-card__description">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($category->description ?? 'Explore our range of products in this category.'), 120) }}
                                </p>
                                <div class="product-card__meta">
                                    <span>
                                        @if(!empty($category->industry_focus))
                                            {{ $category->industry_focus }}
                                        @else
                                            Laboratory equipment
                                        @endif
                                    </span>
                                    @if(!is_null($category->products_count ?? null))
                                        <span>{{ $category->products_count }} {{ \Illuminate\Support\Str::plural('product', $category->products_count) }}</span>
                                    @endif
                                </div>
                                <div class="product-card__footer">
                                    <span class="text-muted small">
                                        Updated {{ $category->updated_at ? $category->updated_at->diffForHumans() : 'recently' }}
                                    </span>
                                    <a href="{{ route('product-categories.show', $category->slug) }}" class="tp-btn tp-btn-sm">
                                        View Products
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted mb-0">No categories available right now. Check back soon.</p>
                    </div>
                @endforelse
            </div>

            @if($categories->hasPages())
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="basic-pagination text-center mt-15">
                            {{ $categories->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
    <!-- category-list-end -->

    @include('frontend.partials.product-card-styles')

@endsection
