@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            @include('users.card')
        </aside>
        <div class="sm:col-span-2 mt-4">
            @if (Auth::id() == $user->id)
                <div class="mt-4">
                    <form method="POST" action="{{ route('profile-update', $user->id)}}">
                        @csrf
                        @method('PUT')
                    
                        <div class="form-control mt-4">
                            <p>ニックネーム</p>
                            <textarea rows="1" name="nickname" class="input input-bordered w-full">{{ $latestUserDetail->nickname }}</textarea>

                            <p>年齢</p>
                            <textarea rows="1" name="age" class="input input-bordered w-full">{{ $latestUserDetail->age }}</textarea>

                            <p>職業</p>
                            <textarea rows="1" name="occupation" class="input input-bordered w-full">{{ $latestUserDetail->occupation }}</textarea>

                            <p>活動分野</p>
                            <textarea rows="1" name="business_area" class="input input-bordered w-full">{{ $latestUserDetail->business_area }}</textarea>
                        </div>
                    
                        <button type="submit" class="btn btn-primary btn-block btn-outline normal-case">編集を保存する</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection    

