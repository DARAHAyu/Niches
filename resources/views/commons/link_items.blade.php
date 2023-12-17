@if (Auth::check())
    {{-- ユーザプロフィールページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('profile-index', Auth::user()->id) }}">{{ Auth::user()->name }}のプロフィール</a></li>
    {{-- 発注者ページへのリンク --}}
    <li><a class = "link link-hover" href="{{ route('sales-orders', Auth::user()->id) }}">依頼文を作成する</a></li> 
    {{-- 受注者ページへのリンク --}}
    <li><a class = "link link-hover" href="{{ route('purchase-orders', Auth::user()->id) }}">提案文を作成する</a></li>
    {{-- 依頼タイムラインへのリンク（トップページとくっつけてもいいかも？） --}}
    <li><a class = "link link-hover" href="{{ route('search-sales', Auth::user()->id) }}">依頼を探す</a></li>
    {{-- 提案タイムラインへのリンク（トップページとくっつけてもいいかも？） --}}
    <li><a class = "link link-hover" href="{{ route('search-purchase', Auth::user()->id) }}">提案を探す</a></li>
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