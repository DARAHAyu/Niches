@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            @include('users.card')
        </aside>
        <div class="sm:col-span-2 mt-4">
            <p>ニックネーム：{{ $latestUserDetail->nickname }}</p>
            <p>年齢：{{ $latestUserDetail->age }}</p>
            <p>職業：{{ $latestUserDetail->occupation }}</p>
            <p>得意領域：{{ $latestUserDetail->business_area }}</p>

            @if(auth()->user()->id == $user->id)
                <a href="{{ route('profile-edit', $user->id)}}" class = "btn btn-primary">プロフィールを編集する</a>
            @endif
        </div>
    </div>
@endsection


