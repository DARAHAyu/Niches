@extends('layouts.app')

@section('content')
    @if (Auth::check())
        @if (isset($othersPurchases))
            <div class="sm:grid sm:grid-cols-3 sm:gap-10">
                <div class="sm:col-span-2 mt-4">
                    @foreach ($othersPurchases as $othersPurchase)
                        <div class="mt-4">
                            <div class="sm:col-span-2 mt-4">
                                <p>作成日時：{{ $othersPurchase->created_at }}</p>
                                <p>最終更新日：{{ $othersPurchase->updated_at }}</p>
                                <p>タイトル：{{ $othersPurchase->title }}</p>
                                <p>提案の概要：{{ $othersPurchase->purchase_abstract }}</p>
                                <a href="{{ route('purchase-show', ['purchaseId' => $othersPurchase->id]) }}" class = "btn normal-case">提案の詳細</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection