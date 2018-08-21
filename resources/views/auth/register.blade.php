@extends('layouts.app')

@section('content')
<div class="content-box">
    <div class="logo"><img src="/images/logo.png" alt="bellamonte logo" class="icon"></div>

    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
        @csrf

        <div class="form-group">
            <input 
                id="name"
                type="text"
                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                placeholder="Name"
            >

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <input
                id="email"
                type="email"
                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                name="email"
                value="{{ old('email') }}"
                required
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
            <button type="submit" class="btn w-25 btn-custom-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
@endsection
