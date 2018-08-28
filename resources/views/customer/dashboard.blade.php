@extends('layouts.customer')

@section('content')
<div class="view-content">
    <h1 class="mb-3">Dashboard</h1>
    <div class="card p-3 w-100 mb-4">
        <h3>Welcome {{ $user->name }}!</h3>
        @if (count($reservations))
            <p>You have pending {{ count($reservations) }} reservation(s). Please deposit the down payment to:</p>
            <p class="mb-0 font-weight-bold">East West Bank</p>
            <p class="mb-0 font-weight-bold">Hotel Bellamonte Inc.</p>
            <p class="mb-0 font-weight-bold">10802000974</p>
        @endif
    </div>
    <h5 class="font-weight-light mb-3">After depositing, Take a photo of your deposit slip and upload it</h5>
    <div class="d-flex justify-content-between flex-wrap">
        @foreach($reservations as $reservation)
            <div class="card position-relative">
                <div class="card-body">
                    {{ Form::open(['url' => '/customer/reservation', 'method' => 'PUT', 'files' => true]) }}
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Check In:</p>
                            <p class="full-date">{{ $reservation->start_date }}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p>Check Out:</p>
                            <p class="full-date">{{ $reservation->end_date }}</p>
                        </div>
                        <div class="options-container">
                            {{ Form::file('image') }}
                            {{ Form::hidden('id', $reservation->id) }}
                            <button class="btn btn-custom-default w-100 mt-2"> Submit Deposit Slip </button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
