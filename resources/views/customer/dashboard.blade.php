@extends('layouts.customer')

@section('content')
    <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
            <h1>Welcome {{ $user->name }}!</h1>
            @if (count($reservations))
                You have pending {{ count($reservations) }} reservation(s). Please deposit the down payment to:
                <hr>
                <i>
                    <h6>East West Bank</h6>
                    <h6>Hotel Bellamonte Inc.</h6>
                    <h6>10802000974</h6>
                </i>
                <hr>
                After depositing, Take a photo of your deposit slip and upload it here:
                <br>
                <br>
                @foreach($reservations as $reservation)
                    {{ Form::open(['url' => '/customer/reservation', 'method' => 'PUT', 'files' => true]) }}
                        <h6>Check In: {{ $reservation->start_date }} </h6>
                        <h6>Check Out: {{ $reservation->end_date }} </h6>
                        {{ Form::file('image') }}
                        {{ Form::hidden('id', $reservation->id) }}
                        <button class="btn btn-primary"> Submit Deposit Slip </button>
                    {{ Form::close() }}
                    <hr>
                @endforeach
            @endif
        </div>
    </div>
@endsection
