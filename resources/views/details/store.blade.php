@if (Auth::id() == $user->id)
    <div class="mt-4">
        <form method="POST" action="{{ route('profile-store') }}">
            @csrf
        
            <div class="form-control mt-4">
                <p>ニックネーム</p><textarea rows="1" name="nickname" class="input input-bordered w-full"></textarea></p>
                <p>年齢<textarea rows="1" name="age" class="input input-bordered w-full"></textarea></p>
                <p>職業</p><textarea rows="1" name="occupation" class="input input-bordered w-full"></textarea></p>
                <p>活動分野<textarea rows="1" name="business_area" class="input input-bordered w-full"></textarea></p>
            </div>
        
            <button type="submit" class="btn btn-primary btn-block normal-case">プロフィールを登録する</button>
        </form>
    </div>
@endif