@extends('layouts.app')

@section('content')
    @if (Auth::id() == $user->id)
        @if (isset($myPurchase))
            <div class="sm:grid sm:grid-cols-3 sm:gap-10">
                <aside class="mt-4">
                    @include('users.card')
                    <a href="{{ route('purchase-create', $user->id) }}" class = "btn btn-primary btn-block normal-case">提案文を作成する</a>
                </aside>
                <div class="sm:col-span-2 mt-4">
                    @foreach ($myPurchase as $myPurchase)
                        <div class="mt-4">
                            <div class="sm:col-span-2 mt-4">
                                <p>作成日時：{{ $myPurchase->created_at }}</p>
                                <p>最終更新日：{{ $myPurchase->updated_at }}</p>
                                <p>タイトル：{{ $myPurchase->title }}</p>
                                <p>提案の概要：{{ $myPurchase->purchase_abstract }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection    
