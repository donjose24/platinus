@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        <h1 class="mb-3">Hello {{ \Auth::user()->name }}!</h1>
        <h4 class="mt-5">Below are our reservations for today:</h4>
        <div class="d-flex justify-content-between flex-wrap">
            @if(count($reservations) == 0)
                No reservations for today.
            @endif
            @foreach($reservations as $reservation)
                <div class="card position-relative">
                    <div class="card-header">
                        <h5>{{ strtoupper($reservation->code) }}</h5>
                        <h5> {{ $reservation->user->name  }} </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Check In:</p>
                            <p class="full-date">{{ $reservation->start_date }}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p>Check Out:</p>
                            <p class="full-date">{{ $reservation->end_date }}</p>
                        </div>
                        <div class="options-container">
                            <a href="/cashier/reservation/{{$reservation->id}}" class="btn btn-custom-default w-100 mt-2">View More Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection