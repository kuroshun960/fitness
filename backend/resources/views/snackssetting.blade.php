@extends('layouts.app')
@section('content')

@if (Auth::check())

@php

// dd($meals); 

@endphp


<div class="backBtn__container">
    <a class="backBtn arrow arrow--right" href="{{URL::to('/')}}"></a>
</div>
    


<div class="meallistpage__hidden">    
    <h2 class="mealssetting__title">登録した食事</h2>

    <div class="mealtype__linkBtn">
        {!! link_to_route('mealssetting.show','食事リスト',[],['class'=>'userRegistBtn']) !!}
        <div class="userRegistBtn mealtype__linkBtn__visit">おやつリスト</div>
        {!! link_to_route('drinks.show','飲み物リスト',[],['class'=>'userRegistBtn']) !!}
    </div>
    

    <div class="meallistpage__scroll">

            <div class="itemsList">

            <div class="itemsHead">
                <p>商品名</p>
                <p>カロリー</p>
                <p>内容量</p>
                <p>値段</p>
                <p>タンパク質</p>
                <p>脂質</p>
                <p>炭水化物</p>
                <p>カロリー/量</p>
                <p>円/量</p>
                <!-- <p>カロリー/円</p> -->
                <!-- <p>量/円</p> -->
                <!-- <p>タンパク質/円</p> -->
                <!-- <p>脂質/円</p> -->
                <!-- <p>炭水化物/円</p> -->
            </div>


            @foreach ($meals as $meal)

                @if ( $meal['mealType'] === 'おやつ')

                <a href="{{ route('mealssetting.updatepage', ['id' => $meal['mealId']]) }}">
                    <div class="itemsHead">
                        <p>{{ $meal['mealName'] }}</p>
                        <p>{{ $meal['mealKcal'] }}kcal</p>
                        
                        <!-- 商品の量の単位がグラムなら -->
                        @if ( isset($meal['mealGram']) )
                            <p>{{ $meal['mealGram'] }}g</p>
                        <!-- 商品の量の単位が個数なら -->
                        @elseif( isset($meal['mealPiece']) )
                            <p>{{ $meal['mealPiece'] }}個</p>
                        @endif

                        <p>{{ $meal['mealPrice'] }}円</p>

                        <p>{{ $meal['mealProtain'] }}p</p>
                        <p>{{ $meal['mealCarbo'] }}f</p>
                        <p>{{ $meal['mealFat'] }}c</p>


                        <!-- 商品の量の単位がグラムなら -->
                        @if ( isset($meal['mealKcalParGram'],) )
                            <p>{{ $meal['mealKcalParGram'] }}kcal/g</p>
                            <p>{{ $meal['mealPriceParGram'] }}円/g</p>
                            <!-- <p>{{ $meal['mealKcalParPrice'] }}kcal/円</p> -->
                            <!-- <p>{{ $meal['mealGramParPrice'] }}g/円</p> -->
                            <!-- <p>{{ $meal['mealProtainParPrice'] }}p/円</p> -->
                            <!-- <p>{{ $meal['mealFatParPrice'] }}f/円</p> -->
                            <!-- <p>{{ $meal['mealCarboParPrice'] }}c/円</p> -->

                        <!-- 商品の量の単位が個数なら -->
                        @elseif( isset($meal['mealKcalParPiece'],) )
                            <p>{{ $meal['mealKcalParPiece'] }}kcal/個</p>
                            <p>{{ $meal['mealPriceParPiece'] }}円/個</p>
                            <!-- <p>{{ $meal['mealKcalParPrice'] }}kcal/円</p> -->
                            <!-- <p>{{ $meal['mealPieceParPrice'] }}個/円</p> -->
                            <!-- <p>{{ $meal['mealProtainParPrice'] }}p/円</p> -->
                            <!-- <p>{{ $meal['mealFatParPrice'] }}f/円</p> -->
                            <!-- <p>{{ $meal['mealCarboParPrice'] }}c/円</p> -->
                            
                        @endif


                    </div>
                </a>

                @endif  

            @endforeach


        </div>
    </div>











</div>


@endif

@endsection