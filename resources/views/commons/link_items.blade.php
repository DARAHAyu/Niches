@if (Auth::check())
    {{-- ユーザプロフィールページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('profile-index') }}">{{ Auth::user()->name }}のプロフィール</a></li>
    {{-- 発注者ページへのリンク --}}
    <li><a class = "link link-hover" href="{{ route('sales-create', Auth::user()->id) }}">依頼文を作成する</a></li> 
    {{-- 受注者ページへのリンク --}}
    <li><a class = "link link-hover" href="{{ route('purchase-create', Auth::user()->id) }}">提案文を作成する</a></li>
    {{-- 自分が作成した依頼一覧ページへのリンク --}}
    <li><a class = "link link-hover" href="{{ route('my-sales', Auth::user()->id) }}">自分が作成した依頼</a></li> 
    {{-- 自分が作成した提案一覧ページへのリンク --}}
    <li><a class = "link link-hover" href="{{ route('my-purchase') }}">自分が作成した提案</a></li> 
    {{-- 依頼タイムラインへのリンク（トップページとくっつけてもいいかも？） --}}
    <li><a class = "link link-hover" href="{{ route('others-sales', Auth::id()) }}">依頼を探す</a></li>
    {{-- 提案タイムラインへのリンク（トップページとくっつけてもいいかも？） --}}
    <li><a class = "link link-hover" href="{{ route('others-purchases', Auth::id()) }}">提案を探す</a></li>
    {{-- メッセージへのリンク --}}
    <li><a class = "link link-hover" href="{{ route('rooms-index')}}">メッセージ</a></li>
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