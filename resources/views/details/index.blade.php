@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <div class="sm:col-span-2 mt-4">
            <p>ニックネーム：{{ $userDetail->nickname }}</p>
            <p>年齢：{{ $userDetail->age }}</p>
            <p>職業：{{ $userDetail->occupation }}</p>
            <p>得意領域：{{ $userDetail->business_area }}</p>
        </div>
    </div>
@endsection