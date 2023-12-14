@if (Auth::id() == $user->id)
    <div class="mt-4">
        <form method="POST" action="{{ route('purchase_orders.store') }}">
            @csrf
        
            <div class="form-control mt-4">
                <p>受注タイトル</p><textarea rows="2" name="title" class="input input-bordered w-full"></textarea></p>
                <p>募集している仕事の内容<textarea rows="2" name="purchase_abstract" class="input input-bordered w-full"></textarea></p>
            </div>
        
            <button type="submit" class="btn btn-primary btn-block normal-case">提案文を作成する</button>
        </form>
    </div>
@endif