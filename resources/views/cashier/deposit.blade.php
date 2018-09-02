@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        <h1 class="mb-3">Deposit Slips Upload</h1>
        <div class="d-flex justify-content-between flex-wrap">
            @foreach($reservations as $reservation)
            <div class="card position-relative">
                <div class="card-header">
                    <h4>{{ $reservation->code }}</h4>
                    <h6>{{ $reservation->user->name }}</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Check In:</p>
                        <p>{{ $reservation->start_date }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p>Check Out:</p>
                        <p>{{ $reservation->end_date }}</p>
                    </div>
                    <div class="options-container">
                        <a href="/cashier/deposit/{{ $reservation->id }}" class="btn btn-success w-100 mt-2"> More Info </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
