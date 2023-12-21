@extends('layouts.app')

@section('content')
    @if (isset($purchase))
        <div class="sm:grid sm:grid-cols-3 sm:gap-10">
            <aside class="mt-4">
                @if (Auth::id() != $purchase->user_id)
                    <a href="{{ route('messages-create', $purchase->user_id) }}" class = "btn btn-primary btn-block normal-case">このユーザに連絡する</a>
                @endif
            </aside>
            <div class="sm:col-span-2 mt-4">
                <div class="mt-4">
                    <div class="sm:col-span-2 mt-4">
                        <p>作成日時：{{ $purchase->created_at }}</p>
                        <p>最終更新日：{{ $purchase->updated_at }}</p>
                        <p>タイトル：{{ $purchase->title }}</p>
                        <p>依頼の概要：{{ $purchase->purchase_abstract }}</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>この提案は削除された可能性があります。</p>
    @endif
@endsection
