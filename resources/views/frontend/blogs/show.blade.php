{{-- resources/views/frontend/blogs/show.blade.php --}}
@extends('layouts.frontend')

{{-- ======================== --}}
{{-- PRIMARY META --}}
{{-- ======================== --}}
@section('meta_title', $blog->meta_title ?: $blog->title)

@php
    $canonical = route('blogs.show', $blog->slug);

    $image = $blog->featured_image
        ? asset('storage/'.$blog->featured_image)
        : asset('assets/img/blog/blog-default.jpeg');

    $desc = $blog->meta_description
        ?: Str::limit(strip_tags($blog->content ?? ''), 160);

    $keywords = $blog->meta_keywords
        ?: 'laboratory equipment, scientific analysis, lab technologies, Anatech Zambia, scientific instruments';

    $published = ($blog->published_at ?? $blog->created_at)?->toAtomString();
    $modified  = $blog->updated_at?->toAtomString();
    $author    = optional($blog->author)->name ?? 'Anatech Editorial Team';
    $category  = optional($blog->category)->name;

    // tags: support array, object, DB JSON, etc.
    $tagNames = collect($blog->tags ?? [])
        ->map(fn($t) => is_object($t) ? ($t->name ?? null) : $t)
        ->filter()
        ->values()
        ->all();
@endphp

@section('meta_description', $desc)
@section('meta_keywords', $keywords)
@section('canonical', $canonical)
@section('og_type', 'article')
@section('og_image', $image)


{{-- ========================================================= --}}
{{-- STRUCTURED DATA: BlogPosting + Breadcrumbs --}}
{{-- ========================================================= --}}
@push('structured_data')

{{-- BlogPosting Schema --}}
<script type="application/ld+json">
{!! json_encode([
  '@context'        => 'https://schema.org',
  '@type'           => 'BlogPosting',
  'mainEntityOfPage'=> ['@type'=>'WebPage','@id'=>$canonical],
  'headline'        => $blog->meta_title ?: $blog->title,
  'description'     => $desc,
  'image'           => [$image],
  'datePublished'   => $published,
  'dateModified'    => $modified,
  'author'          => [
      '@type' => 'Person',
      'name'  => $author
  ],
  'publisher'       => [
      '@type' => 'Organization',
      'name'  => 'Anatech Zambia',
      'logo'  => [
          '@type' => 'ImageObject',
          'url'   => asset('assets/img/logo/logo.png')
      ],
  ],
  'articleSection'  => $category,
  'keywords'        => implode(', ', $tagNames),
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>

{{-- Breadcrumb Schema --}}
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type'    => 'BreadcrumbList',
  'itemListElement' => [
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
      [
        '@type'=>'ListItem',
        'position'=>3,
        'name'=>$blog->title,
        'item'=>$canonical
      ],
  ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>

@endpush


@section('content')
{{-- page content continues… --}}
@php
    $breadcrumbImage = $blog->featured_image
        ? asset('storage/'.$blog->featured_image)
        : asset('assets/img/blog/default.jpg');
@endphp


<!-- breadcrumb-area -->
<section class="breadcrumb__area pt-100 pb-120 breadcrumb__overlay"
         data-background="{{ $breadcrumbImage }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-7 col-md-7">
                <div class="tp-breadcrumb">
                    <h2 class="tp-breadcrumb__title">Blog Details</h2>
                </div>
            </div>
            <!-- <div class="col-xl-6 col-lg-5 col-md-5">
                <div class="tp-breadcrumb__link d-flex align-items-center">
                    <span>Home : <a href="{{ route('blogs.index') }}"> Blogs</a></span>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- breadcrumb-area-end -->


<!-- postbox-area -->
<div class="postbox__area pt-130 pb-110">
    <div class="container">
        <div class="row">

            <!-- MAIN CONTENT -->
            <div class="col-xxl-8 col-xl-8 col-lg-7">
                <div class="postbox__wrapper pr-20">

                    <article class="postbox__item mb-50 transition-3">

                        <!-- FEATURED IMAGE -->
                        <div class="postbox__thumb w-img mb-30">
                            <img src="{{ $blog->featured_image ? asset('storage/'.$blog->featured_image) : asset('assets/img/blog/default.jpg') }}"
                                 alt="{{ $blog->title }}">
                        </div>

                        <div class="postbox__content">

                            <!-- META -->
                            <div class="postbox__meta mb-40">
                                <span>
                                    <i class="fa-regular fa-user"></i> Admin
                                </span>

                                <span>
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $blog->published_at? $blog->published_at->format('M d, Y') : 'Unpublished' }}
                                </span>

                                @if($blog->category)
                                <span>
                                    <i class="fa-regular fa-folder"></i>
                                    {{ $blog->category->name }}
                                </span>
                                @endif
                            </div>

                            <!-- TITLE -->
                            <h3 class="postbox__title mb-35">
                                {{ $blog->title }}
                            </h3>

                            <!-- CONTENT -->
                            <div class="postbox__content-area pb-20">
                                {!! $blog->content !!}
                            </div>


                            <!-- TAGS + SHARE -->
                            <div class="postbox__tag-border pt-40">
                                <div class="row align-items-center">

                                    <!-- TAGS -->
                                    <div class="col-xl-7 col-md-12">
                                        <div class="postbox__tag">
                                            <div class="postbox__tag-list tagcloud">
                                                <span>Tags:</span>

                                                @forelse($blog->tags as $tag)
                                                    <a href="#">{{ $tag->name }}</a>
                                                @empty
                                                    <span class="text-muted">No tags</span>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SHARE -->
                                    <div class="col-xl-5 col-md-12 text-xl-end mt-3 mt-xl-0">
                                        <div class="postbox__social-tag">
                                            <span>Share</span>

                                            @php
                                                $shareUrl = urlencode(request()->fullUrl());
                                                $shareTitle = urlencode($blog->title);
                                            @endphp

                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank">
                                                <i class="fa-brands fa-facebook"></i>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank">
                                                <i class="fa-brands fa-twitter"></i>
                                            </a>
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank">
                                                <i class="fa-brands fa-linkedin"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </article>

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
                                @foreach($categories as $cat)
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

                                @foreach($recentPosts as $post)
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
                    <div class="sidebar__widget mb-55 widget_tag_cloud">
                        <h3 class="sidebar__widget-title mb-25">Popular Tags</h3>
                        <div class="sidebar__widget-content">
                            <div class="tagcloud">
                                @foreach($allTags as $tag)
                                    <a href="#">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- postbox area end -->
@endsection
