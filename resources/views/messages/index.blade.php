@extends('layouts.app')

@section('content')

    <div class = "prose ml-4">
        <h2>メッセージ一覧</h2>
    </div>

    @if(isset($messages))
        <table class = "table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>id</th>
                    <th>メッセージ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr>
                    <td><a class = "link link-hover text-info" href = "#">{{  $message->id }}</a></td>
                    <td>{{ $message->message }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- 新規メッセージ作成ページへのリンク --}}
    <a class = "btn btn-primary" href = "{{ route('messages.create') }}">新規メッセージの投稿</a>
    
@endsection