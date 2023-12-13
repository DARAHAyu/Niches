@if (Auth::id() == $user->id)
    <div class="mt-4">
        <form method="POST" action="{{ route('sales_orders.store') }}">
            @csrf
        
            <div class="form-control mt-4">
                <p>依頼タイトル</p><textarea rows="2" name="title" class="input input-bordered w-full"></textarea></p>
                <p>依頼の概要<textarea rows="2" name="sales_abstract" class="input input-bordered w-full"></textarea></p>
            </div>
        
            <button type="submit" class="btn btn-primary btn-block normal-case">依頼を作成する</button>
        </form>
    </div>
@endif