@extends('layouts.app')

@section('content')
    @if(auth()->user()->hasProfileDetails())
        @include('details.show')
    @else
        @include('details.store')
    @endif
@endsection
