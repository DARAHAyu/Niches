<div class="mt-4">
    @if (isset($purchase_orders))
        <ul class="list-none">
            @foreach ($purchase_orders as $purchase_order)
                <li class="flex items-start gap-x-2 mb-4">
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    <div class="avatar">
                        <div class="w-12 rounded">
                            <img src="{{ Gravatar::get($purchase_order->user->email) }}" alt="" />
                        </div>
                    </div>
                    <div>
                        <div>
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            <a class="link link-hover text-info" href="{{ route('users.show', $purchase_order->user->id) }}">{{ $purchase_order->user->name }}</a>
                            <span class="text-muted text-gray-500">posted at {{ $purchase_order->created_at }}</span>
                        </div>
                        <div>
                            {{-- 依頼のタイトル --}}
                            <p class="mb-0">受注タイトル: </p>
                            <p class="mb-0">{!! nl2br(e($purchase_order->title)) !!}</p>
                        </div>
                        <div>
                            {{-- 依頼の概要 --}}
                            <p class="mb-0">募集している仕事の内容: </p>
                            <p class="mb-0">{!! nl2br(e($purchase_order->purchase_abstract)) !!}</p>
                        </div>
                        <div>
                            @if (Auth::id() == $purchase_order->user_id)
                                {{-- オーダー削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('purchase_orders.destroy', $purchase_order->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case"
                                        onclick="return confirm('id = {{ $purchase_order->id }} を削除しますか？')">削除</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $purchase_orders->links() }}
    @endif
</div>