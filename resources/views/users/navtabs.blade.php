<div class = "tabs">
    {{-- ユーザプロフィール --}}
    <a href = "{{ route('details-index') }}" class = "tab tab-lifted grow {{ Request::routeIs('details-index') ? 'tab-active' : ''}}">
        マイプロフィール
    </a>
    {{-- フォロー一覧タブ --}}
    <a href = "{{ route('user-followings', $user->id) }}" class = "tab tab-lifted grow {{ Request::routeIs('user-followings') ? 'tab-active' : ''}}">
        フォロー一覧
        <div class="badge ml-1">{{ $user->followings_count }}</div>
    </a>
    {{-- フォロワー一覧タブ --}}
    <a href = "{{ route('user-followers', $user->id) }}" class = "tab tab-lifted grow {{ Request::routeIs('user-followers') ? 'tab-active' : ''}}">
        フォロワー一覧
        <div class = "badge ml-1">{{ $user->followers_count }}</div>
    </a>
</div>