@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
        <img src="/image/top.png" alt="" class="top">
            <div class="">
                <div class="d-flex flex-row flex-wrap">

                        @foreach($stocks as $stock)

                            <div class="col-xs-6 col-sm-4 col-md-4 ">
                                <div class="mycart_box">
                                    {{$stock->name}} 
                                    <br>
                                    <br>
                                    <img src="/image/{{$stock->imgpath}}" alt="" class="incart" value="{{ $stock->id }}">
                                    <br>
                                    <form action="/detail/{id}" method="get">
                                        <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                                        <input type="submit" value="商品詳細へ" class="detail-btn-hover detail-btn-top">
                                    </form>
                                    <br>
                                    <form action="mycart" method="post">
                                        @csrf
                                        <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                                        <input type="submit" value="カートに入れる" class="btn-hover cart-btn-top">
                                    </form>

                                </div>
                            </div>
                        @endforeach
                </div>
                <div class="text-center" style="width: 200px;margin: 20px auto;">
                {{ $stocks->links('pagination::default') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
