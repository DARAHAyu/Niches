@extends('layouts.app')

@section('content')
    @if (isset($myPurchase))
        @foreach ($myPurchase as $myPurchase)
            <div class="sm:grid sm:grid-cols-3 sm:gap-10">
                <div class="sm:col-span-2 mt-4">
                    <p>作成日時：{{ $myPurchase->created_at }}</p>
                    <p>最終更新日：{{ $myPurchase->updated_at }}</p>
                    <p>タイトル：{{ $myPurchase->title }}</p>
                    <p>提案の概要：{{ $myPurchase->purchase_abstract }}</p>
                </div>
            </div>
        @endforeach
    @endif
@endsection