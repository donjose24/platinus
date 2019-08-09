@extends('layouts.front')

@section('content')
<div class="home-content">
    <div class="reservation-container">
        @include('search-bar')
    </div>
</div>
<div class="page-content welcome-content">
    <div class="welcome-description">
        {!! $content->content !!}
    </div>
</div>
@endsection
