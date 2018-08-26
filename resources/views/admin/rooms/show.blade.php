@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Room {{ $room->id }}</div>
    <div class="card-body">

        <a href="{{ url('/admin/room') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
        <a href="{{ url('/admin/room/' . $room->id . '/edit') }}" title="Edit Room"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/room', $room->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete Room',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th><td>{{ $room->id }}</td>
                    </tr>
                    <tr><th> Number </th><td> {{ $room->number }} </td></tr><tr><th> Room Type Id </th><td> {{ $room->room_type_id }} </td></tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
