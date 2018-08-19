@extends('layouts.front')

@section('content')
<div class="home-content">
    <h1 class="welcome-text">Experience leisure and recreation within the hustle of Barretto ,Olongapo City</h1>
    <div class="reservation-container">
        <ul>
            <li><input type="text" placeholder="From" class="datetime-picker" /></li>
            <li><input type="text" placeholder="To" class="datetime-picker" /></li>
            <li><input type="text" placeholder="No. of guests" class="no-guest" /></li>
            <li><button class="btn-book-now">Book Now</button></li>
        </ul>
    </div>
</div>
<div class="welcome-content">
    <h1>WELCOME TO HOTEL BELLA MONTE</h1>
    <div class="welcome-description">
        <p>Hotel Bella Monte is an established hotel in Barrio Barretto that offers leisure and recreation within the hustle of Barretto, Olongapo City. Only 10 minutes away from the bars and restaurants that offer a broad selection of diverse cuisines from all over the world.</p>
        <p>The hotel ensures guests comfort and gives them the quality service. With 9 spacious air-conditioned rooms, among the amenities offered are complimentary Wi-Fi access, non-smoking rooms, cable TV, air-conditioned rooms, private bathroom with hot and cold water, some rooms have access to a balcony.</p>
        <p>Take a breather in the hotel's incredible facilities like an outdoor swimming pool, fitness center, massage, and garden area where you can sit back and laze.</p>
        <p>Hotel Bella Monte is an excellent choice for quality accommodation in Barretto for daily and long term stay.</p>
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
