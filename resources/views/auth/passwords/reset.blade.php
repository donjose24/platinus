@extends('layouts.app')

@section('content')
<div class="content-box">
    <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <input
                id="email"
                type="email"
                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                name="email"
                value="{{ $email ?? old('email') }}"
                required
                autofocus
                placeholder="Email"
            >

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            
        </div>

        <div class="form-group">
            <input
                id="password"
                type="password"
                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                name="password"
                required
                placeholder="Password"
            >

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">

            <input
                id="password-confirm"
                type="password"
                class="form-control"
                name="password_confirmation"
                required
                placeholder="Confirm Password"
            >
        </div>

        <div class="form-group text-center mb-0">
            <button type="submit" class="btn w-25 btn-success">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</div>
@endsection
