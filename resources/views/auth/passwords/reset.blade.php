@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="form-header">
        <h2>Reset password</h2>
    </div>
    <form class="well" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-row">

            @auth
                <input class="form-input" type="email" name="email" value="{{ auth()->user()->email }}" readonly="readonly">
            @else
                <input class="form-input" type="email" name="email" required>
            @endauth

            @if ($errors->has('email'))
                <span>
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            
        </div>

        <div class="form-row">

            <label for="password">{{ __('Password') }}</label>

            
                <input type="password" class="form-input" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            
        </div>

        <div class="form-row">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>

            <input type="password" class="form-input" name="password_confirmation" required>
        </div>

        <div class="form-row">
            <button type="submit" class="btn btn-blue">
                {{ __('Reset Password') }}
            </button>
        </div>
        
           
        
    </form>
                
            
</div>
@endsection
