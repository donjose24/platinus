@extends('layouts.front')

@section('content')
<div class="home-content">
    <div class="reservation-container">
        @include('search-bar')
    </div>
</div>
<div class="page-content location-content">
    <h1 class="mb-5">FACILITIES</h1>
    <div class="container">
        <h4 class="font-weight-bold mb-2">General</h4>
        <p style="font-size: 1rem;">Air Conditioning, Grounds, Gym Fitness Center, Outdoor Swimming Pool, Safety Deposit Boxes</p>
        <h4 class="font-weight-bold mb-2">Internet</h4>
        <p style="font-size: 1rem;">Free WiFi in selected areas in the hotel</p>
        <h4 class="font-weight-bold mb-2">Parking</h4>
        <p style="font-size: 1rem;">Private Parking Area (Charges may apply)</p>
        <h4 class="font-weight-bold mb-2">Food and Beverages</h4>
        <p style="font-size: 1rem;">The hotel is home to chill-out venues that have a wide selection of beverages.</p>
    </div>
</div>
@endsection
