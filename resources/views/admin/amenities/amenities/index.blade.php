@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Amenities</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/amenities/create') }}" class="btn btn-success btn-sm" title="Add New amenity">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/amenities') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Title</th><th>Sub Title</th><th>Description</th><th>Image</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($amenities as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->title }}</td><td>{{ $item->sub_title }}</td><td>{{ $item->description }}</td>
                                        <td><img src="{{ $item->image }}" class="card-img-top w-100"></td>
                                        <td>
                                            <a href="{{ url('/admin/amenities/' . $item->id) }}" title="View amenity"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/amenities/' . $item->id . '/edit') }}" title="Edit amenity"><button class="btn btn-primary btn-xs"><i class="fa fa-edit" aria-hidden="true"></i></button></a>

                                            <form method="POST" action="{{ url('/admin/amenities' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete amenity" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $amenities->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
