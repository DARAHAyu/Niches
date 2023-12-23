@extends('layouts.app')

@section('content')

    @include('messages.index')

    <div class = "flex justify-center">
        <form method="POST" action="{{ route('messages-store', $message_room->id) }}" class="w-1/2">
            @csrf
                <div class="form-control my-4">
                    <label for="content" class="label">
                        <span class="label-text">新規メッセージを作成:</span>
                    </label>
                    <input type="text" name="message" class="input input-bordered w-full">
                </div>
            <button type="submit" class="btn btn-primary btn-outline">送信</button>
        </form>
    </div>
@endsection





