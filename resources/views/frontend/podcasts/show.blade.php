@extends('layouts.frontend')

@section('meta_title', $podcast->meta_title ?? $podcast->title)
@section('meta_description', $podcast->meta_description ?? '')
@section('meta_keywords', $podcast->meta_keywords ?? '')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $podcast->title }}</h1>

    @if($podcast->thumbnail)
        <img src="{{ asset('storage/'.$podcast->thumbnail) }}" class="img-fluid mb-4" alt="{{ $podcast->title }}">
    @endif

    <div class="mb-4">
        {!! $podcast->description !!}
    </div>

    @if($podcast->embed_url)
        <div class="ratio ratio-16x9">
            {!! $podcast->embed_url !!}
        </div>
    @endif
</div>
@endsection
