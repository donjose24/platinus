@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Settings</div>
    <div class="card-body">
        <a href="{{ url('/admin/settings/create') }}" class="btn btn-success btn-sm" title="Add New Setting">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>Key</th><th>Value</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($settings as $item)
                    <tr>
                        <td>{{ $item->key }}</td>
                        <td>{{ $item->value }}</td>
                        <td>
                            <a href="{{ url('/admin/settings/' . $item->id) }}" title="View Setting"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/admin/settings/' . $item->id . '/edit') }}" title="Edit Setting"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $settings->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>
    </div>
</div>
@endsection
