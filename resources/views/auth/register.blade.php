@extends('layouts.app')

@section('content')

<div class="container">
    <div class="form-header">
        <h2>Registration</h2>
    </div>
    <form class="well" id="registrationForm" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-row">
            <label for="username">{{ __('Username') }}</label>
            
            <input class="form-input" type="text" name="username" value="{{ old('username') }}" required>
        </div>

        <div class="form-row">
            <label>{{ __('Name') }}</label>
        
            <input class="form-input" type="text" name="name" value="{{ old('name') }}" required>
         
        </div>

        <div class="form-row">
            <label for="email">{{ __('E-Mail Address') }}</label>

            <input class="form-input" type="email" name="email" value="{{ old('email') }}" required>
            
        </div>

        <div class="form-row">
            <label for="password">{{ __('Password') }}</label>

            <input class="form-input" type="password" name="password" required>
            
        </div class="form-row">

        <div class="form-row">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>

            <input class="form-input" type="password" name="password_confirmation" required>
            
        </div>

        <div class="form-row">
            <button type="submit" class="btn btn-blue">{{ __('Register') }}</button>
        </div>
        
 
    </form>

    <br>

    <div class="error">
        
    </div>

    <div class="success">
        
    </div>

</div>
                
@endsection

<script src="{{ asset('js/register.js') }}"></script>
