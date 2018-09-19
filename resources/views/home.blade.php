@extends('layouts.app')

@section('content')


    @if(\Session::has('error'))

        <div>
        
            {{\Session::get('error')}}

        </div>

    @endif

@endsection
