@extends('layouts.app')

@section('content')
    @if(auth()->user()->hasProfileDetails())
        @include('profile.index')
    @else
        @include('details.store')
    @endif
@endsection
