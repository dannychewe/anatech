@php
  // Default SEO Values — ANATECH
  $title        = $title        ?? (trim($__env->yieldContent('meta_title')) 
                    ?: 'Anatech Zambia | Laboratory Equipment, Scientific Instruments & Industrial Supplies');

  $description  = $description  ?? (trim($__env->yieldContent('meta_description')) 
                    ?: 'Anatech supplies laboratory equipment, scientific instruments, chemicals, consumables and industrial solutions for Food & Beverage, Pharmaceuticals, Mining, Environmental Science, Manufacturing and Research Institutions across Zambia and Southern Africa.');

  $keywords     = $keywords     ?? (trim($__env->yieldContent('meta_keywords')) 
                    ?: 'laboratory equipment Zambia, scientific instruments, chemicals & reagents, consumables, industrial supplies, lab solutions, Anatech, analytical technologies Zambia, food beverage labs, pharmaceutical lab equipment, mining lab equipment');

  $author       = $author       ?? (trim($__env->yieldContent('meta_author')) ?: 'Analytical Technologies Zambia Ltd (Anatech)');
  $type         = $type         ?? (trim($__env->yieldContent('og_type')) ?: 'website');

  $image        = $image        ?? (trim($__env->yieldContent('og_image')) 
                    ?: asset('assets/img/og-default.jpg'));

  $canonical    = $canonical    ?? (trim($__env->yieldContent('canonical')) 
                    ?: (request()->has('page') ? url()->current().'?page='.request('page') : url()->current()));

  $twitterCard  = $twitterCard  ?? 'summary_large_image';
  $siteName     = $siteName     ?? 'Anatech Zambia';
  $locale       = $locale       ?? 'en_ZM';

  // Switch robots for staging/local
  $robots       = $robots       ?? (app()->environment(['local','development','staging']) 
                    ? 'noindex, nofollow' 
                    : 'index, follow');

  // Article Extras
  $publishedTime = $publishedTime ?? null;
  $modifiedTime  = $modifiedTime  ?? null;
  $section       = $section       ?? null;
  $tags          = $tags          ?? [];
  $twitterSite   = $twitterSite   ?? null;
  $twitterCreator= $twitterCreator?? null;
@endphp


<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $author }}">
<link rel="canonical" href="{{ $canonical }}">

<!-- Open Graph -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $locale }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Twitter -->
<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
@if(!empty($twitterSite))   <meta name="twitter:site" content="{{ $twitterSite }}"> @endif
@if(!empty($twitterCreator))<meta name="twitter:creator" content="{{ $twitterCreator }}"> @endif

<!-- Robots -->
<meta name="robots" content="{{ $robots }}">

<!-- Article SEO -->
@if($type === 'article')
  @if(!empty($publishedTime))
    <meta property="article:published_time" content="{{ \Illuminate\Support\Carbon::parse($publishedTime)->toIso8601String() }}">
  @endif
  @if(!empty($modifiedTime))
    <meta property="article:modified_time" content="{{ \Illuminate\Support\Carbon::parse($modifiedTime)->toIso8601String() }}">
  @endif
  @if(!empty($section))
    <meta property="article:section" content="{{ $section }}">
  @endif
  @foreach($tags as $t)
    <meta property="article:tag" content="{{ $t }}">
  @endforeach
@endif

<!-- Theme / PWA -->
<meta name="theme-color" content="#016E5B">
<link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#016E5B">
<meta name="msapplication-TileColor" content="#016E5B">

<!-- Extra Meta -->
@stack('meta')
