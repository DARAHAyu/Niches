@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class = "sm:grid sm:grid-cols-3 sm:gap-10">
            @include('orders.purchase_orders')
        </div>
    @else
        
    @endif
@endsection   