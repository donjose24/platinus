@extends('layouts.front')

@section('content')
<div class="home-content">
    <h1 class="welcome-text align-content-center">Experience leisure and recreation within the hustle of Barretto ,Olongapo City</h1>
    <div class="reservation-container">
        {{Form::open(['url' => '/room/search', 'method' => 'get'])}}
            <ul>
                <li><label class="d-block" for="start_date">Start Date</label><input readonly type="text" name="start_date"  placeholder="From" class="datetime-picker" /></li>
                <li><label class="d-block" for="end_date">End Date</label><input readonly type="text" name="end_date" placeholder="To" class="datetime-picker" /></li>
                <li><label class="d-block" for="adults"># of People</label><input readonly type="number" name="adults" class="no-guest spinner" value="0" min="0"/></li>
                <li><button class="btn btn-custom-default w-100">Book Now</button></li>
            </ul>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        {{Form::close()}}
    </div>
</div>
<div class="page-content welcome-content">
    <h1>WELCOME TO HOTEL BELLA MONTE</h1>
    <div class="welcome-description">
        <p class="small">Hotel Bella Monte is an established hotel in Barrio Barretto that offers leisure and recreation within the hustle of Barretto, Olongapo City. Only 10 minutes away from the bars and restaurants that offer a broad selection of diverse cuisines from all over the world.</p>
        <p class="small">The hotel ensures guests comfort and gives them the quality service. With 9 spacious air-conditioned rooms, among the amenities offered are complimentary Wi-Fi access, non-smoking rooms, cable TV, air-conditioned rooms, private bathroom with hot and cold water, some rooms have access to a balcony.</p>
        <p class="small">Take a breather in the hotel's incredible facilities like an outdoor swimming pool, fitness center, massage, and garden area where you can sit back and laze.</p>
        <p class="small">Hotel Bella Monte is an excellent choice for quality accommodation in Barretto for daily and long term stay.</p>
    </div>
    <div class="services-section">
        <div class="service-box">
            <a href="#">
                <div class="icon-img"><i class="fa fa-bed" aria-hidden="true"></i></div>
                <p class="title">Rooms and Rates</p>
                <p class="desc">Stay for as low as PHP 808 per night. 1 Double sized bed, No Tv, No Aircon. Fan Only, bathroom with hot and cold shower. View our rooms and rates here.</p>
            </a>
        </div>
        <div class="service-box">
            <a href="#">
                <div class="icon-img"><i class="fa fa-users" aria-hidden="true"></i></div>
                <p class="title">Facilities and Services</p>
                <p class="desc">View facilities and services offered. Air Conditioning, Complimentary breakfast, Grounds, Gym Fitness Center, and many more.</p>
            </a>
        </div>
        <div class="service-box">
            <a href="#">
                <div class="icon-img"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                <p class="title">Location</p>
                <p class="desc">Contains the map and instructions. For a quick fun and relax vacation away from the hustle and bustle of the city, Bella Monte Hotel Subic is perfectly for you.</p>
            </a>
        </div>
    </div>
</div>
@endsection
