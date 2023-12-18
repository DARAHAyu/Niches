@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            @include('users.card')
        </aside>
        <div class="sm:col-span-2 mt-4">
            @if (Auth::id() == $user->id)
                <div class="mt-4">
                    <form method="POST" action="{{ route('purchase-store') }}">
                        @csrf
                    
                        <div class="form-control mt-4">
                            <p>タイトル</p>
                            <textarea rows="1" name="title" class="input input-bordered w-full"></textarea>

                            <p>提案の概要</p>
                            <textarea rows="1" name="purchase_abstract" class="input input-bordered w-full"></textarea>
                        </div>
                    
                        <button type="submit" class="btn btn-primary btn-block normal-case">提案を登録する</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection    

