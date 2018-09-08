@extends('layouts.backend')

@section('content')
<div class="view-content">
    <h1 class="mb-3">Room Types</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ url('/admin/room_types/create') }}" class="btn btn-custom-primary" title="Add New RoomType">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>

        {!! Form::open(['method' => 'GET', 'url' => '/admin/room_types', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
            <span class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="d-flex justify-content-between flex-wrap">
        @foreach($roomtypes as $item)
            <div class="card position-relative">
                {!! Form::open([
                    'method' => 'DELETE',
                    'url' => ['/admin/room_types', $item->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-times" aria-hidden="true"></i>', array(
                            'type' => 'submit',
                            'class' => 'btn-delete',
                            'title' => 'Delete Room Type',
                            'onclick'=>'return confirm("Confirm delete?")'
                    )) !!}
                {!! Form::close() !!}
                <div class="position-relative card-img-top">
                    <img src="{{ $item->image_url }}" alt="">
                </div>
                <div class="card-body">
                    <h4>{{ $item->name }}</h4>
                    <p class="room-desc">{{ $item->description }}</p>
                    <h6 class="mb-4">No. of Pax: {{ $item->rooms()->count() }}</h6>
                    <div class="options-container d-flex justify-content-between align-items-center">
                        <a class="btn btn-custom-default" href="{{ url('/admin/room_types/' . $item->id) }}" title="View RoomType">View</a>
                        <a class="btn btn-custom-default" href="{{ url('/admin/room_types/' . $item->id . '/edit') }}" title="Edit RoomType">Edit</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="pagination-wrapper"> {!! $roomtypes->appends(['search' => Request::get('search')])->render() !!} </div>
@endsection
