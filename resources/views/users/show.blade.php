@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </aside>
        <div class="sm:col-span-2 mt-4">
            <p>他に、ログインユーザーの基本情報の表示・登録機能を追加する予定です</p>
            <p>（職業、年齢、場所、得意カテゴリ、実績など）</p>
        </div>
    </div>
@endsection