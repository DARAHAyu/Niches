<div class="mt-4">
    @if (isset($sales_orders))
        <ul class="list-none">
            @foreach ($sales_orders as $sales_order)
                <li class="flex items-start gap-x-2 mb-4">
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    <div class="avatar">
                        <div class="w-12 rounded">
                            <img src="{{ Gravatar::get($sales_order->user->email) }}" alt="" />
                        </div>
                    </div>
                    <div>
                        <div>
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            <a class="link link-hover text-info" href="{{ route('users.show', $sales_order->user->id) }}">{{ $sales_order->user->name }}</a>
                            <span class="text-muted text-gray-500">posted at {{ $sales_order->created_at }}</span>
                        </div>
                        <div>
                            {{-- 依頼のタイトル --}}
                            <p class="mb-0">依頼のタイトル: </p>
                            <p class="mb-0">{!! nl2br(e($sales_order->title)) !!}</p>
                        </div>
                        <div>
                            {{-- 依頼の概要 --}}
                            <p class="mb-0">依頼の概要: </p>
                            <p class="mb-0">{!! nl2br(e($sales_order->sales_abstract)) !!}</p>
                        </div>
                        <div>
                            @if (Auth::id() == $sales_order->user_id)
                                {{-- オーダー削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('sales_orders.destroy', $sales_order->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case"
                                        onclick="return confirm('id = {{ $sales_order->id }} を削除しますか？')">削除</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $sales_orders->links() }}
    @endif
</div>