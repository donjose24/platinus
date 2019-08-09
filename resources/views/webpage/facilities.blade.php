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
        @foreach($amenities as $amenity)
            <div class="card reservation-room" style="width: 27%">
                <div class="position-relative card-img-top-container">
                    <img
                     class="card-img-top w-100"
                     src={{ $amenity->image }}
                     alt="Standard room"
                     />
                </div>
                <div class="card-body">
                    <h4 class="font-weight-bold card-title">{{ $amenity->title }} </h4>
                    <h6 class="font-weight-bold sub-card-title">{{ $amenity->sub_title }}</h6>
                    <p class="card-text">{{ $amenity->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
