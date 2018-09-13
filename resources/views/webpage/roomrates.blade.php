@extends('layouts.front')

@section('content')
<div class="home-content">
    <h1 class="welcome-text">Room &amp; Rates</h1>
    <div class="reservation-container">
      {{Form::open(['url' => '/room/search', 'method' => 'get'])}}
        <ul>
            <li><label class="d-block" for="start_date">Start Date</label><input readonly type="text" name="start_date"  placeholder="From" class="datetime-picker" /></li>
            <li><label class="d-block" for="end_date">End Date</label><input readonly type="text" name="end_date" placeholder="To" class="datetime-picker" /></li>
            <li><label class="d-block" for="adults">Number of Persons</label><input readonly type="number" name="adults" class="no-guest spinner" value="0" min="0"/></li>
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
          <h4 class="font-weight-bold card-title">Standard room</h4>
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
          <h4 class="font-weight-bold card-title">Standard Room Twin Bed</h4>
          <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
          <p class="card-text">Air conditioned, hot and cold shower, free Wifi, swimming pool, and cable T.V. twin bed</p>
          <h5 class="font-weight-bold mb-0 room-price">PHP 2,000 per night</h5>
        </div>
      </div>
      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/f40da9cd32e7c86b4b8b7f6afcc1413c.jpg"
            alt="Studio type with Kitchen A"
          />
        </div>
        <div class="card-body">
          <h4 class="font-weight-bold card-title">Studio type with Kitchen A</h4>
          <h6 class="font-weight-bold sub-card-title">3 Persons</h6>
          <p class="card-text">Air conditioned, hot and cold shower, free Wifi, swimming pool, and cable T.V. Double bed</p>
          <h5 class="font-weight-bold mb-0 room-price">PHP 2,500 per night</h5>
        </div>
      </div>

      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/427b2b66a46f757b3fa9ece19d6d501e.jpg"
            alt="1 Bedroom Apartment"
          />
        </div>
        <div class="card-body">
          <h4 class="font-weight-bold card-title">1 Bedroom Apartment</h4>
          <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
          <p class="card-text">With one queen size bed, kitchen, receiving area, and Cable TV, with complimentary use of the swimming pool.</p>
          <h5 class="font-weight-bold mb-0 room-price">PHP 3,500 per night</h5>
        </div>
      </div>
      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/6aa91d6eb855f24f2da5362d99ee37ab.jpg"
            alt="Fan Room"
          />
        </div>
        <div class="card-body">
          <h4 class="font-weight-bold card-title">Fan Room</h4>
          <h6 class="font-weight-bold sub-card-title">2 Persons</h6>
          <p class="card-text">1 Double sized bed, Fan ventilated, bathroom with hot and cold shower</p>
          <h5 class="font-weight-bold mb-0 room-price">PHP 950 per night</h5>
        </div>
      </div>
      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/839e3f6923cdde1b68b3750993397c3e.jpg"
            alt="Studio Type with Kitchen B Poolside B"
          />
        </div>
        <div class="card-body">
          <h4 class="font-weight-bold card-title">Studio Type with Kitchen B Poolside B</h4>
          <h6 class="font-weight-bold sub-card-title">3 Persons</h6>
          <p class="card-text">Air conditioned, hot and cold shower, free Wifi, swimming pool, and cable T.V. Double bed</p>
          <h5 class="font-weight-bold mb-0 room-price">PHP 3,000 per night</h5>
        </div>
      </div>
      <div class="card reservation-room">
        <div class="position-relative card-img-top-container">
          <img 
            class="card-img-top w-100"
            src="https://goto.plus/booking/genericwebssi/imaging.php?image=https://occupancy.plus/images/rooms/e382052d9e0b7d17f3e56c698ff3948e.jpg"
            alt="Studio Type with Kitchen C"
          />
        </div>
        <div class="card-body">
          <h4 class="font-weight-bold card-title">Studio Type with Kitchen C</h4>
          <h6 class="font-weight-bold sub-card-title">3 Persons</h6>
          <p class="card-text">Air conditioned, hot and cold shower, free Wifi, swimming pool, and cable T.V. Double bed</p>
          <h5 class="font-weight-bold mb-0 room-price">PHP 2,500 per night</h5>
        </div>
      </div>
    </div>
</div>
@endsection
