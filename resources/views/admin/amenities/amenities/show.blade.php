@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">amenity {{ $amenity->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/amenities') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/amenities/' . $amenity->id . '/edit') }}" title="Edit amenity"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/amenities' . '/' . $amenity->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete amenity" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $amenity->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $amenity->title }} </td></tr><tr><th> Sub Title </th><td> {{ $amenity->sub_title }} </td></tr><tr><th> Description </th><td> {{ $amenity->description }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
