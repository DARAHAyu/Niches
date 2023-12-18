@extends('layouts.app')

@section('content')
    @if (Auth::id() == $user->id)
        @if (isset($othersSales))
            <div class="sm:grid sm:grid-cols-3 sm:gap-10">
                <div class="sm:col-span-2 mt-4">
                    @foreach ($othersSales as $othersSale)
                        <div class="mt-4">
                            <div class="sm:col-span-2 mt-4">
                                <p>作成日時：{{ $othersSale->created_at }}</p>
                                <p>最終更新日：{{ $othersSale->updated_at }}</p>
                                <p>タイトル：{{ $othersSale->title }}</p>
                                <p>依頼の概要：{{ $othersSale->sales_abstract }}</p>
                                <a href="{{ route('sales-show', ['userId' => $othersSale->user_id, 'saleId' => $othersSale->id]) }}" class = "btn normal-case">依頼の詳細</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection    
