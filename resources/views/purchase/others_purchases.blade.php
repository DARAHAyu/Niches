@extends('layouts.app')

@section('content')
    @if (Auth::id() == $user->id)
        @if (isset($othersPurchases))
            <div class="sm:grid sm:grid-cols-3 sm:gap-10">
                @foreach ($othersPurchases as $othersPurchase)
                    <aside class="mt-4">
                        @include('users.card', ['user' => $othersPurchase->user])
                    </aside>
                    <div class="sm:col-span-2 mt-4">
                            <div class="mt-4">
                                <div class="sm:col-span-2 mt-4">
                                    <p>作成日時：{{ $othersPurchase->created_at }}</p>
                                    <p>最終更新日：{{ $othersPurchase->updated_at }}</p>
                                    <p>タイトル：{{ $othersPurchase->title }}</p>
                                    <p>依頼の概要：{{ $othersPurchase->purchase_abstract }}</p>
                                    <p>カテゴリー：{{ $othersPurchase->category }}</p>
                                    <p>予算：{{ $othersPurchase->budget }}円</p>
                                    <p>募集締め切り日：{{ $othersPurchase->schedule }}</p>
                                    <a href="{{ route('purchase-show', ['purchaseId' => $othersPurchase->id]) }}" class = "btn normal-case">依頼の詳細</a>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
@endsection    
