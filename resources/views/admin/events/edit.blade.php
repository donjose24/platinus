@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit event #{{ $event->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/events') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        <form method="POST" action="{{ url('/admin/events/' . $event->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.events.form', ['formMode' => 'edit'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
