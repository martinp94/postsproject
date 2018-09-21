@extends('layouts.app')

@section('content')

<div class="container">
    <div class="form-header">
        <h1>Login</h1>
    </div>
    <form class="well" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-row">
            {{-- <label for="email">{{ __('E-Mail Address') }}</label> --}}

            
            <input id="email" class="form-input" type="email" name="email" placeholder="E-Mail Address" required autocomplete="off">

            @if ($errors->has('email'))
                <span>
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            
        </div>

        <div class="form-row">
           {{--  <label for="password">{{ __('Password') }}</label> --}}

            
            <input id="password" class="form-input" type="password" name="password" placeholder="Password" required autocomplete="off">

            @if ($errors->has('password'))
                <span>
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            
        </div>

        <div class="form-row">
            
            <label for="remember">
                {{ __('Remember Me') }}
            </label>
            <input type="checkbox" class="form-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
  
        </div>

        <div class="form-row">
          
            <button type="submit" class="btn btn-green" style="width: 15vw;">
                {{ __('Login') }}
            </button>

            <a href="{{ route('password.request') }}">
                <label>
                    {{ __('Forgot Your Password?') }}
                </label>             
            </a>
            
        </div>
    </form>
</div>

<script>
   
$( document ).ready(function() {
    $("#email").val('');
    $("#password").val('');
});


</script>                

@endsection


