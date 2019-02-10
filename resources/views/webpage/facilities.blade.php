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
        <div class="card reservation-room">
            <div class="position-relative card-img-top-container">
                <img
                    class="card-img-top w-100"
                    src="https://imgur.com/TUeyqTr"
                    alt="Standard room"
                />
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold card-title">Transport Services</h4>
                <h6 class="font-weight-bold sub-card-title">10-15 Persons</h6>
                <p class="card-text">From Clark Pampanga to our Hotel</p>
            </div>
        </div>
    </div>
</div>
@endsection
