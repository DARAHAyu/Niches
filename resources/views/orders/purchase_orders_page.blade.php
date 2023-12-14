@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class = "sm:grid sm:grid-cols-3 sm:gap-10">
            <aside class = "mt-4">
                
                @include('users.card')
            </aside>
            <div class = "sm:col-span-2">
                
                @include('orders.purchase_form')
                
                @include('orders.purchase_orders')
            </div>
        </div>
    @else
        
    @endif
@endsection   