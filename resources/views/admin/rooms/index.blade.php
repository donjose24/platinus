@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Room</div>
    <div class="card-body">
        <a href="{{ url('/admin/room/create') }}" class="btn btn-success btn-sm" title="Add New Room">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>

        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>Room Number</th><th>Room Type </th> <th>Status</th><th>Notes</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($room as $item)
                    <tr>
                        <td>{{ $item->number }}</td>
                        <td>{{ $item->roomType->name }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->note }}</td>
                        <td>
                            <a href="{{ url('/admin/room/' . $item->id) }}" title="View Room"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/admin/room/' . $item->id . '/edit') }}" title="Edit Room"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                            
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
