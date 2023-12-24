@extends('layouts.app')

@section('content')
    <div class = "prose ml-4">
        <h2>{{ $user->name }}のダイレクトメッセージ一覧</h2>
    </div>

    @if (isset($messageRoomsData))
        <table class = "table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>相手</th>
                    <th>最後のメッセージ</th>
                    <th>送信日時</th>
                    <th>連絡</th>
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
                        <td>
                            {{-- メッセージルームの相手のidを渡す --}}
                            <a href="{{ route('messages-create', $data['recipient']->id) }}" class = "bg-blue-800 hover:bg-blue-700 text-white rounded px-4 py-2">メッセージルームを開く</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection