@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        <h1 class="mb-3">Deposit Slips Upload</h1>
        <div class="d-flex justify-content-between flex-wrap">
            @if(count($reservations) == 0)
                No deposit slips uploaded Yet!
            @endif
            @foreach($reservations as $reservation)
            <div class="card position-relative">
                <div class="card-body">
                    <div class="mb-3">
                        <h3 class="mb-1">{{ $reservation->user->name  }}</h3>
                        <h5>{{ strtoupper($reservation->code) }}</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0">Check In:</p>
                        <p class="mb-0 full-date">{{ $reservation->start_date }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p>Check Out:</p>
                        <p class="full-date">{{ $reservation->end_date }}</p>
                    </div>
                    <div class="options-container">
                        <a href="/cashier/deposit/{{ $reservation->id }}" class="btn btn-custom-default w-100 mt-2"> More Info </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
