@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Page {{ $page->id }}</div>
    <div class="card-body">

        <a href="{{ url('/admin/pages') }}" title="Back"><button class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
        <a href="{{ url('/admin/pages/' . $page->id . '/edit') }}" title="Edit Page"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/pages', $page->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete Page',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th><td>{{ $page->id }}</td>
                    </tr>
                    <tr><th> Title </th><td> {{ $page->title }} </td></tr><tr><th> Content </th><td> {{ $page->content }} </td></tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
