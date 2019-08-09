@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">event {{ $event->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/events') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/events/' . $event->id . '/edit') }}" title="Edit post"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/events' . '/' . $event->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete event" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $event->id }}</td>
                                    </tr>
                                    <tr><th> Event Name </th><td> {{ $event->event_name }} </td></tr><tr><th> Description </th><td> {{ $event->description }} </td></tr><tr><th> Image Url </th><td> {{ $post->image_url }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
