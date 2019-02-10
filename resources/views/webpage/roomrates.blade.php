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
            <div class="card reservation-room">
                <div class="position-relative card-img-top-container">
                    <img
                        class="card-img-top w-100"
                        src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/6e74766b5cfaced732955a8f1d857f70.jpg"
                        alt="Standard room"
                    />
                </div>
                <div class="card-body">
                    <h4 class="font-weight-bold card-title">Studio Twin Room</h4>
                    <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
                    <p class="card-text">Air-conditioned, Queen sized bed, Hot and Cold shower, TV with Cable, Complimentary Use of the swimming pool, Free Wifi</p>
                    <h5 class="font-weight-bold mb-0 room-price">PHP 1,600 per night</h5>
                </div>
            </div>
            <div class="card reservation-room">
                <div class="position-relative card-img-top-container">
                    <img
                        class="card-img-top w-100"
                        src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/f6a848d482ad64b01d4091fb478ec616.jpg"
                        alt="Standard Room Twin Bed"
                    />
                </div>
                <div class="card-body">
                    <h4 class="font-weight-bold card-title">Studio Twin Room Deluxe</h4>
                    <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
                    <p class="card-text">Air conditioned, hot and cold shower, free Wifi, swimming pool, and cable T.V. twin bed</p>
                    <h5 class="font-weight-bold mb-0 room-price">PHP 2,000 per night</h5>
                </div>
            </div>
        </div>
@endsection
