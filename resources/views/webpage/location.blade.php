@extends('layouts.front')

@section('content')
<div class="home-content">
    <h1 class="welcome-text align-content-center">Experience leisure and recreation within the hustle of Barretto ,Olongapo City</h1>
    <div class="reservation-container">
    {{Form::open(['url' => '/room/search', 'method' => 'get'])}}
        <ul>
            <li><label class="d-block" for="start_date">Start Date</label><input readonly type="text" name="start_date"  placeholder="From" class="datetime-picker" /></li>
            <li><label class="d-block" for="end_date">End Date</label><input readonly type="text" name="end_date" placeholder="To" class="datetime-picker" /></li>
            <li><label class="d-block" for="adults">Number of Persons</label><input readonly type="number" name="adults" class="no-guest spinner" value="0" min="0"/></li>
            <li><label class="d-block" for="children"># of Children</label><input readonly type="number" name="children" class="no-guest spinner" value="0" min="0"/></li>
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
    <h1>Location</h1>
    <h5 class="mb-2">#15 del Pilar St. Bo., Barretto Olongapo, Zambales, Philippines</h5>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 mb-4"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.52103743157!2d120.26052116537923!3d14.852115524843787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x898878ac2f214293!2sHOTEL+BELLA+MONTE!5e0!3m2!1sen!2sph!4v1535472433140" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>
        <div class="col-6">
          <h3>AREA INFORMATION</h3>
          <ul class="m-0 p-0">
            <li class="mb-3">For a quick fun and relaxing vacation away from the hustle and bustle of the city, Bella Monte Hotel Subic is perfectly situated at #15 Del Pilar Street Baloy Baretto. Nestled near the beaches, restaurants and bars, your stay at our resort will absolutely satisfy your awaited vacation. </li>
            <li class="mb-3">For a perfect night out with friends even with your family, our resort is very accessible to some of the nightlife bars such as: Midnight Ranbler Bar and Angel Witch. Baretto Mini Mart and Savers Appliance Depot are located just few minutes away from our property.</li>
            <li>A large swimming pool can be enjoyed in our vicinity. We provide everything you deserve to make your stay as pleasurable as possible. </li>
          </ul>
        </div>
        <div class="col-6">
          <h3>HOW TO GET HERE</h3>
          <ul class="m-0 p-0">
            <li class="mb-3">From Manila, there are Victory Liner Terminals that can take you to Olongapo City. The estimated travel time is 3-4 hours. Once you arrive at the Victory Liner Terminal in Olongapo, there will be a Blue Jeepney Terminal that you need to take just ask the driver to drop you off at Del Pilar St. (landmark will be Rico's Restaurant). You may ride a tricycle or walk going to the hotel.</li>
            <li>From Subic Bay Freeport Zone, via private car. Proceed to the Kalaklan Gate, make a left turn and ride through the National Highway until you reach The Baretto Area, the best landmark is Rico's Restaurant on your right side.</li>
          </ul>
        </div>
      </div>
    </div>
</div>
@endsection
