@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
            <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:1.2em; padding:24px 0px;">
            {{ Auth::user()->name }}さんのカートの中身</h1>
                
            <div class="">
                <p class="text-center">{{ $message ?? '' }}</p><br>
                <div class="d-flex flex-row flex-wrap">

                @if($myCarts->isNotEmpty())

                    @foreach($myCarts as $myCart)
                        <div class="mycart_box">
                            {{ $myCart->stock->name }} <br>
                            {{ number_format($myCart->stock->fee) }}円 <br>
                            <img src="/image/{{$myCart->stock->imgpath}}" alt="" class="incart" >
                            <br>

                            <form action="/cartdelete" method="post">
                                @csrf
                                <input type="hidden" name="stock_id" value="{{ $myCart->stock->id }}">
                                <input type="submit" value="カートから削除する">
                            </form>
                        </div>
                    @endforeach

                    <div class="buy-box p-2">
                    <form action="/checkout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg text-center buy-btn" >購入する</button>
                    </form>
                        <p style="font-size:1.2em; font-weight:bold;">個数：{{$count}}個<br>
                        <p style="font-size:1.2em; font-weight:bold;">合計金額：{{number_format($sum)}}円</p>
                    </div>

                @else
                    <p class="text-center">カートはからっぽです。</p>
                @endif
            </div>
                <form action="/" method="get">
                    <button type="submit" class="btn btn-back-hover btn-lg text-center back-btn" >商品一覧へ戻る</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection