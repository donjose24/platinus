@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Service {{ $service->id }}</div>
    <div class="card-body">

        <a href="{{ url('/admin/service') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
        <a href="{{ url('/admin/service/' . $service->id . '/edit') }}" title="Edit Service"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['/admin/service', $service->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete Service',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th><td>{{ $service->id }}</td>
                    </tr>
                    <tr><th> Name </th><td> {{ $service->name }} </td></tr><tr><th> Price </th><td> {{ $service->price }} </td></tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
