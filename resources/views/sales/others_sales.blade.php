@extends('layouts.app')

@section('content')
    @if (Auth::id() == $user->id)
        @if (isset($othersSales))

            @include('commons.search_form')

            <div class="sm:grid sm:grid-cols-3 sm:gap-10">
                @foreach ($othersSales as $othersSale)
                    <aside class="mt-4">
                        @include('users.card', ['user' => $othersSale->user])
                    </aside>
                    <div class="sm:col-span-2 mt-4">
                            <div class="mt-4">
                                <div class="sm:col-span-2 mt-4">
                                    <p>作成日時：{{ $othersSale->created_at }}</p>
                                    <p>最終更新日：{{ $othersSale->updated_at }}</p>
                                    <p>タイトル：{{ $othersSale->title }}</p>
                                    <p>依頼の概要：{{ $othersSale->sales_abstract }}</p>
                                    <p>カテゴリー：{{ $othersSale->category->category }}</p>
                                    <p>予算：{{ $othersSale->budget }}</p>
                                    <p>募集締め切り日：{{ $othersSale->schedule }}</p>
                                    <a href="{{ route('sales-show', ['saleId' => $othersSale->id]) }}" class = "btn normal-case">依頼の詳細</a>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
@endsection    
