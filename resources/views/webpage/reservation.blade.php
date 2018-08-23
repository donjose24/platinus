@extends('layouts.front')

@section('content')
<div class="home-content">
    <h1 class="welcome-text">Book a Room</h1>
    <div class="reservation-container">
        {{Form::open(['url' => '/room/search', 'method' => 'get'])}}
            <ul>
                <li><input type="text" name="start_date" placeholder="From" class="datetime-picker" /></li>
                <li><input type="text" name="end_date" placeholder="To" class="datetime-picker" /></li>
                <li><input type="number" min="0" name="guests" placeholder="No. of guests" class="no-guest" /></li>
                <li><button class="btn-book-now">Check Available Rooms</button></li>
            </ul>
        {{Form::close()}}
    </div>
</div>
<div class="page-content reservation-content">
    <h1>Available Rooms</h1>
    <div class="d-flex justify-content-around flex-wrap">
      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/6e74766b5cfaced732955a8f1d857f70.jpg"
            alt="Standard Room"
          />
        </div>
        <div class="card-body">
          <h5 class="font-weight-bold card-title">Standard room</h5>
          <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
          <p class="card-text">Air-conditioned, Queen sized bed, Hot and Cold shower, TV with Cable, Complimentary Use of the swimming pool, Free Wifi</p>
          <h4 class="font-weight-bold mb-3 room-price">PHP 1,600 per night</h4>
          <a href="#" class="btn w-100 p-2 btn-custom-primary">Book Now</a>
        </div>
      </div>
      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/f6a848d482ad64b01d4091fb478ec616.jpg"
            alt="Standard Room"
          />
        </div>
        <div class="card-body">
          <h5 class="font-weight-bold card-title">Standard Room Twin Bed</h5>
          <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
          <p class="card-text">Air-conditioned, Queen sized bed, Hot and Cold shower, TV with Cable, Complimentary Use of the swimming pool, Free Wifi</p>
          <h4 class="font-weight-bold mb-3 room-price">PHP 1,600 per night</h4>
          <a href="#" class="btn w-100 p-2 btn-custom-primary">Book Now</a>
        </div>
      </div>
      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/f40da9cd32e7c86b4b8b7f6afcc1413c.jpg"
            alt="Standard Room"
          />
        </div>
        <div class="card-body">
          <h5 class="font-weight-bold card-title">Studio type with Kitchen A</h5>
          <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
          <p class="card-text">Air-conditioned, Queen sized bed, Hot and Cold shower, TV with Cable, Complimentary Use of the swimming pool, Free Wifi</p>
          <h4 class="font-weight-bold mb-3 room-price">PHP 1,600 per night</h4>
          <a href="#" class="btn w-100 p-2 btn-custom-primary">Book Now</a>
        </div>
      </div>

      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/427b2b66a46f757b3fa9ece19d6d501e.jpg"
            alt="Standard Room"
          />
        </div>
        <div class="card-body">
          <h5 class="font-weight-bold card-title">1 Bedroom Apartment</h5>
          <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
          <p class="card-text">Air-conditioned, Queen sized bed, Hot and Cold shower, TV with Cable, Complimentary Use of the swimming pool, Free Wifi</p>
          <h4 class="font-weight-bold mb-3 room-price">PHP 1,600 per night</h4>
          <a href="#" class="btn w-100 p-2 btn-custom-primary">Book Now</a>
        </div>
      </div>
      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/6aa91d6eb855f24f2da5362d99ee37ab.jpg"
            alt="Standard Room"
          />
        </div>
        <div class="card-body">
          <h5 class="font-weight-bold card-title">Fan Room</h5>
          <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
          <p class="card-text">Air-conditioned, Queen sized bed, Hot and Cold shower, TV with Cable, Complimentary Use of the swimming pool, Free Wifi</p>
          <h4 class="font-weight-bold mb-3 room-price">PHP 1,600 per night</h4>
          <a href="#" class="btn w-100 p-2 btn-custom-primary">Book Now</a>
        </div>
      </div>
      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/839e3f6923cdde1b68b3750993397c3e.jpg"
            alt="Standard Room"
          />
        </div>
        <div class="card-body">
          <h5 class="font-weight-bold card-title">Studio Type with Kitchen B Poolside B</h5>
          <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
          <p class="card-text">Air-conditioned, Queen sized bed, Hot and Cold shower, TV with Cable, Complimentary Use of the swimming pool, Free Wifi</p>
          <h4 class="font-weight-bold mb-3 room-price">PHP 1,600 per night</h4>
          <a href="#" class="btn w-100 p-2 btn-custom-primary">Book Now</a>
        </div>
      </div>
    </div>
</div>
@endsection
