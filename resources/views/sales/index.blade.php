@extends('layouts.app')

@section('content')
    @if (Auth::id() == $user->id)
        @if (isset($mySales))
            <div class="sm:grid sm:grid-cols-3 sm:gap-10">
                <aside class="mt-4">
                    @include('users.card')
                    <a href="{{ route('sales-create', $user->id) }}" class = "btn btn-primary btn-block normal-case">依頼文を作成する</a>
                </aside>
                <div class="sm:col-span-2 mt-4">
                    @foreach ($mySales as $mySale)
                        <div class="mt-4">
                            <div class="sm:col-span-2 mt-4">
                                <p>作成日時：{{ $mySale->created_at }}</p>
                                <p>最終更新日：{{ $mySale->updated_at }}</p>
                                <p>タイトル：{{ $mySale->title }}</p>
                                <p>依頼の概要：{{ $mySale->sales_abstract }}</p>
                                <p>カテゴリー：{{ $mySale->category->category }}</p>
                                <p>予算：{{ $mySale->budget }}</p>
                                <p>募集締め切り日：{{ $mySale->schedule }}</p>
                                <div>
                                    <a href="{{ route('sales-show', ['userId' => $user->id, 'saleId' => $mySale->id]) }}" class = "btn normal-case">依頼の詳細</a>
                                    <form method="POST" action="{{ route('sales-destroy', $mySale->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class = "btn btn-error btn-outline normal-case" value="依頼を削除する" onclick="return confirm('本当に削除しますか？')">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection    
