<div>
    <form action="{{ $isSalesPage ? route('sales-search') : route('purchases-search')}}" method="GET" class="flex">
        <input type="text" name="keyword" placeholder="キーワードで依頼を検索…" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">    
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">検索</button>
    </form>
</div>

{{-- 将来的にこの検索フォームで自分の依頼/提案、他人の依頼/提案を検索できるよう、条件で分岐させる --}}