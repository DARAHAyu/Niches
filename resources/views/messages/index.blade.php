    <div class = "prose ml-4">
        <h2>{{ $receiver->name }}とのダイレクトメッセージ</h2>
    </div>

    @if (isset($messages))
        <table class = "table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>送信者</th>
                    <th>メッセージ</th>
                    <th>送信日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $sender->name }}</a></td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
