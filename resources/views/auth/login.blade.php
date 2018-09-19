@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-row">
            <label for="email">{{ __('E-Mail Address') }}</label>

            
            <input class="form-input" type="email" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span>
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            
        </div>

        <div class="form-row">
            <label for="password">{{ __('Password') }}</label>

            
            <input class="form-input" type="password" name="password" required>

            @if ($errors->has('password'))
                <span>
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            
        </div>

        <div class="form-row">
            
            <input type="checkbox" class="form-input" name="remember" {{ old('remember') ? 'checked' : '' }}>

            <label for="remember">
                {{ __('Remember Me') }}
            </label>
                
        </div>

        <div>
          
            <button type="submit" class="btn btn-blue">
                {{ __('Login') }}
            </button>

            <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            
        </div>
    </form>
</div>

                

@endsection
