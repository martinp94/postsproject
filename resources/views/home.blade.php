@extends('layouts.app')

@section('content')

<script src="{{ asset('js/eventHandlers.js') }}"></script>

@include('posts.create')

@include('posts.all')

@endsection


