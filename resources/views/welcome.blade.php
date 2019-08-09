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

    <h1>Upcoming Events</h1>
    <div class="d-flex justify-content-between flex-wrap">
        @foreach($events as $event)
            <div class="card reservation-room" style="width: 27%">
                <div class="position-relative card-img-top-container">
                    <img
                     class="card-img-top w-100"
                     src={{ $event->image_url }}
                     alt="Standard room"
                     />
                </div>
                <div class="card-body">
                    <h4 class="font-weight-bold card-title">{{ $event->event_name }} </h4>
                    <p class="card-text">{{ $event->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
