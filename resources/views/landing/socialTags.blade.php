
@section('socialTags')
    <!-- COMMON TAGS -->
    <meta charset="utf-8">
    <title>[Download] {{$title}}</title>
    <!-- Search Engine -->
    <meta name="description" content="{{$subtitle}}\n{{$description}}">
    <meta name="image" content="{{$thumbnail}}">
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="[Download] {{$title}}">
    <meta itemprop="description" content="{{$subtitle}}\n{{$description}}">
    <meta itemprop="image" content="{{$thumbnail}}">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="[Download] {{$title}}">
    <meta name="twitter:description" content="{{$subtitle}}\n{{$description}}">
    <meta name="twitter:image:src" content="{{$thumbnail}}">
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="[Download] {{$title}}">
    <meta name="og:description" content="{{$subtitle}}\n{{$description}}">
    <meta name="og:image" content="{{$thumbnail}}">
    <meta name="og:url" content="https://{{ config('app.promote_url') }}/{{$code}}">
    <meta name="og:site_name" content="config('app.promote_url')">
    <meta name="og:locale" content="en_US">
    <meta name="og:type" content="website">
@endsection