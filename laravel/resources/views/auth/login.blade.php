@extends('layouts.auth')

@section('content')
<div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Icon -->
                <div class="fadeIn first">
                    <img src="{{ asset('assets/images/PTTimg.png') }}" id="icon" alt="User Icon" />
                    <h1>Login</h1>
                </div>
                <!-- Login Form -->
                <form id="form-login" method="POST" action="{{ route('login') }}">
                    @csrf
                    <span id="login_error_message"></span>
                    <input type="email" id="email" name="email" class="fadeIn second @error('email') is-invalid @enderror" maxlength="50"
                        placeholder="Enter email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    
                    <input type="password" id="password" name="password" class="fadeIn third @error('password') is-invalid @enderror" maxlength="50"
                        placeholder="Enter password" required autocomplete="current-password">

                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <input type="submit" class="fadeIn fourth " value="Login">
                    <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                     @endif -->
                </form>

            </div>
        </div>
@endsection
