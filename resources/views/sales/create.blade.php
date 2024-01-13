@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            @include('users.card')
        </aside>
        <div class="sm:col-span-2 mt-4">
            @if (Auth::id() == $user->id)
                <div class="mt-4">
                    <form method="POST" action="{{ route('sales-store') }}">
                        @csrf
                        
                        <div class="form-control my-4">
                            <label for="text" class="label">
                                <span class="label-text">タイトル</span>
                            </label>
                            <input type="text" name="title" class="input input-bordered w-full">
                        </div>

                        <div class="form-control my-4">
                            <label for="text" class="label">
                                <span class="label-text">依頼の概要</span>
                            </label>
                            <input type="text" name="sales_abstract" class="input input-bordered w-full">
                        </div>

                        <div class="form-control my-4">
                            <label for="category" class="label">
                                <span class="label-text">カテゴリー</span>
                            </label>
                            <select name="category" id="category" class="input input-bordered w-full">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-control my-4">
                            <label for="number" class="label">
                                <span class="label-number">予算（円）</span>
                            </label>
                            <input type="number" name="budget" class="input input-bordered w-full">
                        </div>

                        <div class="form-control my-4">
                            <label for="date" class="label">
                                <span class="label-date">募集締め切り日</span>
                            </label>
                            <input type="date" name="schedule" class="input input-bordered w-full">
                        </div>
                    
                        <button type="submit" class="btn btn-primary btn-block normal-case btn-outline">依頼を登録する</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection    

