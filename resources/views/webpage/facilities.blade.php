@extends('layouts.front')

@section('content')
<div class="home-content">
    <div class="reservation-container">
        @include('search-bar')
    </div>
</div>
<div class="page-content location-content">
    <h1 class="mb-5">Facilities and Services</h1>
    <div class="d-flex justify-content-between flex-wrap">
        <div class="card reservation-room" style="width: 27%">
            <div class="position-relative card-img-top-container">
                <img
                    class="card-img-top w-100"
                    src="https://imgur.com/ZAibtOq.jpg"
                    alt="Standard room"
                />
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold card-title">Transport Services</h4>
                <h6 class="font-weight-bold sub-card-title">10-15 Persons</h6>
                <p class="card-text">From Clark Pampanga to our Hotel</p>
            </div>
        </div>
        <div class="card reservation-room" style="width: 27%">
            <div class="position-relative card-img-top-container">
                <img
                    class="card-img-top w-100"
                    src="https://imgur.com/TUeyqTr.jpg"
                    alt="Standard room"
                />
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold card-title">Swimming Pool</h4>
                <h6 class="font-weight-bold sub-card-title">20 People Capacity</h6>
                <p class="card-text">Open 24/7</p>
            </div>
        </div>
        <div class="card reservation-room" style="width: 27%">
            <div class="position-relative card-img-top-container">
                <img
                    class="card-img-top w-100"
                    src="https://imgur.com/RakUdLw.jpg"
                    alt="Standard room"
                />
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold card-title">Ping Pong Table</h4>
            </div>
        </div>
        <div class="card reservation-room" style="width: 27%">
            <div class="position-relative card-img-top-container">
                <img
                    class="card-img-top w-100"
                    src="https://imgur.com/YcHjHny.jpg"
                    alt="Standard room"
                />
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold card-title">Cafeteria</h4>
            </div>
        </div>
        <div class="card reservation-room" style="width: 27%">
            <div class="position-relative card-img-top-container">
                <img
                    class="card-img-top w-100"
                    src="https://imgur.com/Ij9WKAL.jpg"
                    alt="Standard room"
                />
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold card-title">Laundry</h4>
                <h6 class="font-weight-bold sub-card-title">Monday - Saturday</h6>
            </div>
        </div>
        <div class="card reservation-room" style="width: 27%">
            <div class="position-relative card-img-top-container">
                <img
                    class="card-img-top w-100"
                    src="https://imgur.com/2HmJ1Ok.jpg"
                    alt="Standard room"
                />
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold card-title">Family KTV</h4>
                <h6 class="font-weight-bold sub-card-title">Upon reservation</h6>
            </div>
        </div>
    </div>
</div>
@endsection
