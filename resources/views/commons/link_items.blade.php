@if (Auth::check())
    {{-- ユーザプロフィールページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('users.show', Auth::user()->id) }}">{{ Auth::user()->name }}のプロフィール</a></li>
    {{-- 発注者ページへのリンク --}}
    <li><a class = "link link-hover" href="#">仕事を依頼する</a></li>
    {{-- 受注者ページへのリンク --}}
    <li><a class = "link link-hover" href="#">仕事を受注する</a></li>
    {{-- タイムラインへのリンク（トップページとくっつけてもいいかも？） --}}
    <li><a class = "link link-hover" href="#">仕事を探す</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">サインアップ</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">ログイン</a></li>
@endif