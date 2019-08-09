@extends('layouts.front')

@section('content')
    <div class="home-content">
        <h1 class="welcome-text">Room &amp; Rates</h1>
        <div class="reservation-container">
            @include('search-bar')
        </div>
    </div>
    <div class="page-content reservation-content">
        <h1>Room &amp; Rates</h1>
        <div class="d-flex justify-content-between flex-wrap">
            @foreach($rooms as $room)
                <div class="card reservation-room">
                    <div class="position-relative card-img-top-container">
                        <img
                         class="card-img-top w-100"
                         src="{{ $room->image_url }}"
                         alt="Standard room"
                         />
                    </div>
                    <div class="card-body">
                        <h4 class="font-weight-bold card-title">{{ $room->name }}</h4>
                        <h6 class="font-weight-bold sub-card-title">{{ $room->capacity }} Person(s)</h6>
                        <p class="card-text">{{ $room->description }}</p>
                        <h5 class="font-weight-bold mb-0 room-price">PHP {{ number_format($room->daily_rate, 2) }} per night</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
