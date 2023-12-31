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
                                <a href="{{ route('purchase-show', ['userId' => $user->id, 'purchaseId' => $myPurchase->id]) }}" class = "btn normal-case">提案の詳細</a>
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('purchase-destroy', $myPurchase->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class = "btn btn-error btn-outline normal-case" value="提案を削除する" onclick="return confirm('本当に削除しますか？')">
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection    
