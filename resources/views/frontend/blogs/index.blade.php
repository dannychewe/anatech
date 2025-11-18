@extends('layouts.frontend')

@php
  $page      = (int) request('page', 1);
  $title     = $page > 1 ? "Anatech Blog — Page {$page}" : 'Anatech Blog';
  $desc      = 'Explore expert articles, product insights, laboratory trends, scientific equipment guides, industry standards, and technical knowledge from Anatech Zambia.';
  $canonical = $page > 1 ? request()->url().'?page='.$page : request()->url();
@endphp

@section('meta_title', $title)
@section('meta_description', $desc)
@section('meta_keywords', 'Anatech blog, laboratory articles, scientific equipment, lab trends Zambia, analytical instruments, lab supply insights')
@section('canonical', $canonical)
@section('og_type', 'website')

{{-- Prev/Next pagination --}}
@section('pagination_links')
  @if($blogs->currentPage() > 1)
    <link rel="prev" href="{{ $blogs->url($blogs->currentPage() - 1) }}">
  @endif
  @if($blogs->hasMorePages())
    <link rel="next" href="{{ $blogs->url($blogs->currentPage() + 1) }}">
  @endif
@endsection

{{-- JSON-LD for Blog ItemList + Breadcrumbs --}}
@push('structured_data')
@php
  $itemList = [
    '@context' => 'https://schema.org',
    '@type'    => 'ItemList',
    'name'     => 'Anatech Blog',
    'numberOfItems'  => $blogs->count(),
    'itemListElement'=> [],
  ];

  foreach ($blogs as $i => $b) {
    $bImg = $b->featured_image
      ? asset('storage/'.$b->featured_image)
      : asset('assets/img/post_placeholder.jpeg');

    $itemList['itemListElement'][] = [
      '@type'   => 'ListItem',
      'position'=> ($blogs->firstItem() ?? 1) + $i,
      'item'    => [
        '@type'         => 'BlogPosting',
        'headline'      => $b->title,
        'url'           => route('blogs.show', $b->slug),
        'image'         => [$bImg],
        'datePublished' => optional($b->published_at ?? $b->created_at)->toAtomString(),
        'author'        => [
            '@type'=>'Person',
            'name'=> optional($b->author)->name ?? 'Anatech Team'
        ],
      ],
    ];
  }

  $breadcrumbs = [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => array_values(array_filter([
      [
        '@type'=>'ListItem',
        'position'=>1,
        'name'=>'Home',
        'item'=>url('/')
      ],
      [
        '@type'=>'ListItem',
        'position'=>2,
        'name'=>'Blog',
        'item'=>route('blogs.index')
      ],
      $blogs->currentPage() > 1
        ? [
            '@type'=>'ListItem',
            'position'=>3,
            'name'=>'Page '.$blogs->currentPage(),
            'item'=>request()->fullUrl()
          ]
        : null,
    ])),
  ];
@endphp

<script type="application/ld+json">{!! json_encode($itemList, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush


@section('content')
<!-- breadcrumb-area -->
<section class="breadcrumb__area pt-100 pb-120 breadcrumb__overlay"
         data-background="{{ asset('assets/img/banner/breadcrumb-01.jpg') }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-7">
                <div class="tp-breadcrumb">
                    <h2 class="tp-breadcrumb__title">Blogs</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-5">
                <div class="tp-breadcrumb__link d-flex align-items-center">
                    <span>Home : <a href="{{ route('blogs.index') }}">Blogs</a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb-area-end -->


<!-- blog area -->
<div class="postbox-area pt-120 pb-80">
    <div class="container">
        <div class="row">

            <!-- MAIN POSTS -->
            <div class="col-xxl-8 col-xl-8 col-lg-7">
                <div class="postbox pr-20 pb-50">

                    @foreach($blogs as $blog)
                        <article class="postbox__item format-image mb-60 transition-3">

                            <!-- IMAGE -->
                            <div class="postbox__thumb w-img mb-35">
                                <a href="{{ route('blogs.show', $blog->slug) }}">
                                    <img src="{{ $blog->featured_image ? asset('storage/'.$blog->featured_image) : asset('assets/img/blog/default.jpg') }}"
                                         alt="{{ $blog->title }}">
                                </a>
                            </div>

                            <!-- CONTENT -->
                            <div class="postbox__content">

                                <div class="postbox__meta mb-40">
                                    <span>
                                        <i class="fa-regular fa-user"></i> Admin
                                    </span>

                                    <span>
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Unpublished' }}
                                    </span>

                                    @if($blog->category)
                                        <span>
                                            <i class="fa-regular fa-folder"></i>
                                            {{ $blog->category->name }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Title -->
                                <h3 class="postbox__title mb-40">
                                    <a href="{{ route('blogs.show', $blog->slug) }}">
                                        {{ $blog->title }}
                                    </a>
                                </h3>

                                <!-- Excerpt -->
                                <div class="postbox__text mb-40">
                                    <p>{{ $blog->excerpt }}</p>
                                </div>

                                <div class="postbox__read-more">
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="tp-btn">Read more</a>
                                </div>

                            </div>
                        </article>
                    @endforeach


                    <!-- PAGINATION -->
                     @if ($blogs->hasPages())
    <div class="basic-pagination mt-50">
        <nav>
            <ul class="pagination-list d-flex justify-content-center">
                {{-- Previous Page --}}
                @if ($blogs->onFirstPage())
                    <li class="disabled"><span><i class="fa-light fa-arrow-left-long"></i></span></li>
                @else
                    <li>
                        <a href="{{ $blogs->previousPageUrl() }}">
                            <i class="fa-light fa-arrow-left-long"></i>
                        </a>
                    </li>
                @endif

                {{-- Page Numbers --}}
                @foreach ($blogs->links()->elements[0] ?? [] as $page => $url)
                    @if ($page == $blogs->currentPage())
                        <li><span class="current">{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($blogs->hasMorePages())
                    <li>
                        <a href="{{ $blogs->nextPageUrl() }}">
                            <i class="fa-light fa-arrow-right-long"></i>
                        </a>
                    </li>
                @else
                    <li class="disabled"><span><i class="fa-light fa-arrow-right-long"></i></span></li>
                @endif
            </ul>
        </nav>
    </div>
@endif

                    

                </div>
            </div>


            <!-- SIDEBAR -->
            <div class="col-xxl-4 col-xl-4 col-lg-5">
                <div class="sidebar__wrapper pl-25 pb-50">

                    


                    <!-- CATEGORIES -->
                    <div class="sidebar__widget mb-40">
                        <h3 class="sidebar__widget-title mb-25">Categories</h3>
                        <div class="sidebar__widget-content">
                            <ul>

                                @foreach(\App\Models\Category::orderBy('name')->get() as $cat)
                                    <li>
                                        <a href="#">
                                            {{ $cat->name }}
                                            <span>{{ $cat->blogs()->count() }}</span>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>


                    <!-- RECENT POSTS -->
                    <div class="sidebar__widget mb-55">
                        <h3 class="sidebar__widget-title mb-25">Recent Posts</h3>

                        <div class="sidebar__widget-content">
                            <div class="sidebar__post rc__post">

                                @foreach(\App\Models\Blog::latest()->take(4)->get() as $post)
                                    <div class="rc__post mb-20 d-flex align-items-center">

                                        <div class="rc__post-thumb">
                                            <a href="{{ route('blogs.show', $post->slug) }}">
                                                <img src="{{ $post->featured_image ? asset('storage/'.$post->featured_image) : asset('assets/img/blog/default-sm.jpg') }}"
                                                     alt="">
                                            </a>
                                        </div>

                                        <div class="rc__post-content">
                                            <div class="rc__meta">
                                                <span>{{ $post->published_at? $post->published_at->format('d M, Y') : '' }}</span>
                                            </div>

                                            <h3 class="rc__post-title">
                                                <a href="{{ route('blogs.show', $post->slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($post->title, 40) }}
                                                </a>
                                            </h3>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                    <!-- TAGS -->
                    <div class="sidebar__widget mb-55">
                        <h3 class="sidebar__widget-title mb-25">Popular Tags</h3>
                        <div class="sidebar__widget-content">
                            <div class="tagcloud">

                                @foreach(\App\Models\Tag::orderBy('name')->get() as $tag)
                                    <a href="#">{{ $tag->name }}</a>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- end sidebar -->

        </div>
    </div>
</div>
<!-- postbox area end -->

@endsection
