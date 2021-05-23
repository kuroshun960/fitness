@extends('layouts.app')
@section('content')

@if (Auth::check())


<a class="backBtn arrow arrow--right" href="{{URL::to('/')}}"></a>


<style>

    .item{
        margin-bottom: 10px;
    }

</style>


<div>



    <h2 class="mealssetting__title">{{ $day }}の食事内容</h2>

    <div class="daypage_meallist">


                <div class="daypage_meallist__rows__title" style='display: flex;'>
                <p>商品名</p>
                <p>カロリー</p>
                <p>タンパク質</p>
                <p>脂質</p>
                <p>炭水化物</p>
                <p>費用</p>
                <p>摂取量</p>
                </div>


            @foreach ( $eatmeals as $eatmeal )
            <div class="daypage_meallist__rows__container">

                    <div class="daypage_meallist__rows" style='display: flex;'>
                    <p>{{ $eatmeal->name }}</p>
                    <p>{{ $eatmeal->eatKcal }}kcal</p>
                    <p>{{ $eatmeal->eatProtain }}p</p>
                    <p>{{ $eatmeal->eatFat }}f</p>
                    <p>{{ $eatmeal->eatCarbo }}c</p>
                    <p>{{ $eatmeal->eatPrice }}円</p>
                    <p>{{ $eatmeal->eatNet }}</p>
                    </div>

                    <div>
                    {!! Form::open(['route' => ['eats.destroy']]) !!}
                        {!! Form::submit('削除', [ 'name' => $eatmeal->id,'value' => $eatmeal->id,'class' => 'btn btn-danger btn-sm eatsdestroy_btn']) !!}
                    {!! Form::close() !!}
                    </div>

                </div>
            @endforeach

            
            @foreach ( $protaintasks as $protaintask )
            <div class="daypage_protain__rows" style='display: flex;'>

                        <p>プロテイン</p>
                        <p>{{ $protaintask->kcal }}kcal</p>
                        <p>{{ $protaintask->protain }}p</p>
                        <p>{{ $protaintask->fat }}f</p>
                        <p>{{ $protaintask->carbo }}c</p>
                        <p>-</p>
                        <p>-</p>

            </div>
                
            @endforeach

    </div>

    <div class="daypage_nutritiondate">
        <div><p>総カロリー</p><p>{{ $nutdata['allKcal'] }} kcal</p></div>
        <div><p>総タンパク質</p><p>{{ $nutdata['allProtain'] }} P</p></div>
        <div><p>総脂質</p><p>{{ $nutdata['allFat'] }} F</p></div>
        <div><p>総炭水化物</p><p>{{ $nutdata['allCarbo'] }} C</p></div>
        <div><p>総費用</p><p>{{ $nutdata['allPrice'] }} 円</p></div>
    </div>





</div>



@endif

@endsection