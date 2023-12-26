@if (Auth::id() != $user->id)
    @if (Auth::user()->is_following($user->id))
        {{-- アンフォローボタンのフォーム --}}
        <form method = "POST" action = "{{ route('user-unfollow', $user->id) }}">
            @csrf
            @method('DELETE')
            <button type = "submit" class = "btn btn-error btn-block normal-case btn-outline"
                onclick="return confirm('id = {{ $user->id }}のフォローを外します。よろしいですか？')">フォローを外す</button>
        </form>
    @else
        {{-- フォローボタンのフォーム --}}
        <form method = "POST" action = "{{ route('user-follow', $user->id) }}">
            @csrf
            <button type = "submit" class = "btn btn-primary btn-block normal-case btn-outline">フォローする</button>
        </form>
    @endif
@endif