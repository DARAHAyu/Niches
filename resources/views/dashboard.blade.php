{{-- 
 @extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class = "sm:grid sm:grid-cols-3 sm:gap-10">
            <aside class = "mt-4">
                
                @include('users.card')
            </aside>
            <div class = "sm:col-span-2">
                
                @include('orders.form')
                
                @include('orders.sales_orders')
            </div>
        </div>
    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>Nichesへようこそ！</h2>
                    
                    @if (Auth::check())
                    
                    @else
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">今すぐサインアップ</a>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection   --}}



@extends('layouts.app')

@section('content')
    <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
        <div class="hero-content text-center my-10">
            <div class="max-w-md mb-10">
                <h2>Nichesへようこそ！</h2>
                @if (Auth::check())

                @else
                <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">Sign up now!</a>
                @endif
            </div>
        </div>
    </div>
@endsection
