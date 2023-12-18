@extends('layouts.app')

@section('content')
    @if (isset($mySales))
        @if (Auth::id() == $user->id)
            @foreach ($mySales as $mySale)
                <div class="sm:grid sm:grid-cols-3 sm:gap-10">
                    <div class="sm:col-span-2 mt-4">
                        <p>作成日時：{{ $mySale->created_at }}</p>
                        <p>最終更新日：{{ $mySale->updated_at }}</p>
                        <p>タイトル：{{ $mySale->title }}</p>
                        <p>依頼の概要：{{ $mySale->sales_abstract }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    @endif
@endsection