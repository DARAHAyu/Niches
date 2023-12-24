@extends('layouts.app')

@section('content')
    <div class = "prose ml-4">
        <h2>{{ $user->name }}のダイレクトメッセージ一覧</h2>
    </div>

    @if (isset($messageRoomsData))
        <table class = "table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>送信相手</th>
                    <th>最後のメッセージ</th>
                    <th>送信日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messageRoomsData as $data)
                    <tr>
                        <td>{{ $data['recipient']->name }}</a></td>
                        <td>
                            @if ($data['lastMessage'])
                                {{ $data['lastMessage']->message }}
                            @else 
                                <p>【メッセージはまだ送信されていません】</p>
                            @endif
                        </td>
                        <td>
                            @if ($data['lastMessage'])
                                {{ $data['lastMessage']->created_at }}
                            @else 
                                <p>N/A</p>
                            @endif 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection