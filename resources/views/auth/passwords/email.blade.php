@extends('layouts.app')

@section('content')
<div class="container">
    
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif

    <div class="form-header">
        <h2>Reset password</h2>
    </div>
    <form class="well" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            @auth
                <input class="form-input" type="email" name="email" value="{{ auth()->user()->email }}" readonly="readonly">
            @else
                <input class="form-input" type="email" name="email" required>
            @endauth
            
        </div>

        @if ($errors->has('email'))
            <span>
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

        <div class="form-row">
            <button type="submit" class="btn btn-blue">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
            
        
            
    </form>
                  
</div>
@endsection
