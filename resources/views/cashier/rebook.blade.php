@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        <h1 class="mb-3">Rebooking Confirmation</h1>
        <h4> Customer Name: {{ $reservation->user->name }} </h4>
        <h4>{{ $reservation->code }}</h4>
        <h5> New start date: {{ app('request')->start_date }}</h5>
        <h5> New end date: {{ app('request')->end_date }}</h5>
    </div>
@endsection
