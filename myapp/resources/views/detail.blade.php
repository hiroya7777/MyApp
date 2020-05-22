@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
            <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:1.2em; padding:24px 0px;">
            商品の詳細情報</h1>
    
                <div class="flex-row flex-wrap">
                    <div class="detail_box">
                        {{ $stock->name }} 
                        <br>
                        <br>
                        <img src="/image/{{$stock->imgpath}}" alt="" class="indetail">
                    </div>
                    <div class="detail_box">
                        価格{{ number_format($stock->fee) }}円 <br>
                        {{ $stock->detail }} <br>
                        <br>
                    </div>
                </div>
                <div class="detail-btn flex-row flex-wrap">
                    <form action="/" method="get">
                    @csrf
                        <button type="submit" class="btn btn-back-hover btn-lg text-center back-btn" >商品一覧へ戻る</button>
                    </form>
                    <form action="/mycart" method="post">
                    @csrf
                        <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                        <button type="submit" class="btn btn-hover btn-lg text-center cart-btn" >カートに入れる</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection