@extends('layouts.app')

@section('content')
    <div class="content-box">
        <div class="logo"><img src="/images/logo.jpg" alt="platanus logo" class="icon"></div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
            @csrf

            <div class="form-group">
                <input
                        id="email"
                        type="email"
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email"
                        value="{{ old('email') }}" required
                        placeholder="Email"
                >

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group text-center mb-0">
                <button type="submit" class="btn btn-small btn-custom-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
@endsection
