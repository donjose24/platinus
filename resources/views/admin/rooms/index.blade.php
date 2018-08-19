@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Room</div>
    <div class="card-body">
        <a href="{{ url('/admin/room/create') }}" class="btn btn-success btn-sm" title="Add New Room">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>

        {!! Form::open(['method' => 'GET', 'url' => '/admin/room', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
            <span class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
        {!! Form::close() !!}

        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Room Number</th><th>Room Type </th> <th>Daily Rate</th><th>Weekly Rate</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($room as $item)
                    <tr>
                        <td>{{ $item->number }}</td>
                        <td>{{ $item->roomType->name }}</td>
                        <td>{{ number_format($item->daily_rate,2) }}</td>
                        <td>{{ number_format($item->weekly_rate,2) }}</td>
                        <td>
                            <a href="{{ url('/admin/room/' . $item->id) }}" title="View Room"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/admin/room/' . $item->id . '/edit') }}" title="Edit Room"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/admin/room', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete Room',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $room->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
</div>
@endsection