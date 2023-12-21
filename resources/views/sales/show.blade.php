@extends('layouts.app')

@section('content')
    @if (isset($sale))
        <div class="sm:grid sm:grid-cols-3 sm:gap-10">
            <aside class="mt-4">
                @if (Auth::id() != $sale->user_id)
                    <a href="{{ route('messages-create', $sale->user_id) }}" class = "btn btn-primary btn-block normal-case">このユーザに連絡する</a>
                @endif
            </aside>
            <div class="sm:col-span-2 mt-4">
                <div class="mt-4">
                    <div class="sm:col-span-2 mt-4">
                        <p>作成日時：{{ $sale->created_at }}</p>
                        <p>最終更新日：{{ $sale->updated_at }}</p>
                        <p>タイトル：{{ $sale->title }}</p>
                        <p>依頼の概要：{{ $sale->sales_abstract }}</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>この依頼は消去された可能性があります。</p>
    @endif
@endsection
