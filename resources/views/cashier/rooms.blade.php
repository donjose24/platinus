@extends('layouts.cashier')

@section('content')
    <div class="card">
        <div class="card-header">Room Maintenance</div>
        <div class="card-body">
            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td> {{ $room->number }} </td>
                            <td> {{ $room->roomType->name }} </td>
                            <td> {{ $room->status }} </td>
                            <td>
                                @if($room->status != "inactive" && $room->status != "checked-in")
                                    {{ Form::open(['url' => '/cashier/room/inactive']) }}
                                        {{ Form::hidden('room_id', $room->id) }}
                                        <button class="btn btn-danger"> Mark as inactive</button>
                                    {{ Form::close() }}
                                @elseif ($room->status != "checked-in")
                                    <button class="btn btn-custom-primary"> Mark as active</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
