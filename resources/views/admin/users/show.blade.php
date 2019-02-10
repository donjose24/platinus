@extends('layouts.backend')

@section('content')

    <div class="card">
        <div class="card-header">User</div>
        <div class="card-body">

            <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/admin/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a>
            @if (!$user->role()->first() === 'admin')
                {!! Form::open([
                    'method' => 'DELETE',
                    'url' => ['/admin/users', $user->id],
                    'style' => 'display:inline'
               ]) !!}
                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete User',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
                {!! Form::close() !!}
            @endif
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID.</th> <th>Name</th><th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->id }}</td> <td> {{ $user->name }} </td><td> {{ $user->email }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
