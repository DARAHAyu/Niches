@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>id = {{ $message->id }}のメッセージ詳細ページ</h2>
    </div>

    <table class="table w-full my-4">
        <tr>
            <th>id</th>
            <td>{{ $message->id }}</td>
        </tr>

        <tr>
            <th>メッセージ</th>
            <td>{{ $message-> }}</td>
        </tr>
    </table>