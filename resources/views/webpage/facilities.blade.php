@extends('layouts.front')

@section('content')
<div class="home-content">
    <h1 class="welcome-text align-content-center">Experience leisure and recreation within the hustle of Barretto ,Olongapo City</h1>
    <div class="reservation-container">
    {{Form::open(['url' => '/room/search', 'method' => 'get'])}}
        <ul>
            <li><label class="d-block" for="start_date">Start Date</label><input readonly type="text" name="start_date"  placeholder="From" class="datetime-picker" /></li>
            <li><label class="d-block" for="end_date">End Date</label><input readonly type="text" name="end_date" placeholder="To" class="datetime-picker" /></li>
            <li><label class="d-block" for="adults"># of Guests</label><input readonly type="number" name="adults" class="no-guest spinner" value="0" min="0" max="50"/></li>
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
