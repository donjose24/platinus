@extends('layouts.front')

@section('content')
<div class="home-content">
    <h1 class="welcome-text align-content-center">Experience leisure and recreation within the hustle of Barretto ,Olongapo City</h1>
    <div class="reservation-container">
        {{Form::open(['url' => '/room/search', 'method' => 'get'])}}
            <ul>
                <li><label for="start_date">Start Date</label><input type="text" name="start_date"  placeholder="From" class="datetime-picker" /></li>
                <li><label for="end_date">End Date</label><input type="text" name="end_date" placeholder="To" class="datetime-picker" /></li>
                <li><label for="adults"># of Adults</label><input type="number" name="adults" class="no-guest spinner" value="0" min="0"/></li>
                <li><label for="children"># of Children</label><input type="number" name="children" class="no-guest spinner" value="0" min="0"/></li>
                <li><button class="btn btn-success">Book Now</button></li>
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
                <p class="desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum architecto animi qui expedita!</p>
            </a>
        </div>
        <div class="service-box">
            <a href="#">
                <div class="icon-img"><i class="fa fa-users" aria-hidden="true"></i></div>
                <p class="title">Facilities and Services</p>
                <p class="desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum architecto animi qui expedita!</p>
            </a>
        </div>
        <div class="service-box">
            <a href="#">
                <div class="icon-img"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                <p class="title">Location</p>
                <p class="desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum architecto animi qui expedita!</p>
            </a>
        </div>
    </div>
</div>
@endsection
