@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        {{ Form::open(['url' => '/cashier/rebook']) }}
        <h1 class="mb-3">Rebooking Confirmation</h1>
        <h4> Customer Name: {{ $reservation->user->name }} </h4>
        <h4>{{ $reservation->code }}</h4>
        <h5> New start date: {{ app('request')->start_date }}</h5>
        <h5> New end date: {{ app('request')->end_date }}</h5>
        @if(count($roomsWillBeRemoved) != 0)
            <br>
            <br>
            <h5>Rooms below will get removed as they are already occupied.</h5>
            <ul>
            @foreach($roomsWillBeRemoved as $room)
                <li>{{ \App\RoomType::find($room)->name }}</li>
            @endforeach
            </ul>
        @endif
        {{ Form::hidden('start_date', app('request')->start_date) }}
        {{ Form::hidden('end_date', app('request')->end_date) }}
        {{ Form::hidden('reservation_id', $reservation->id) }}
        <a href="/cashier/reservation/{{$reservation->id}}" class="btn btn-danger"> Cancel </a>
        <button class="btn btn-custom-primary"> Rebook </button>
        {{ Form::close() }}
    </div>
@endsection
