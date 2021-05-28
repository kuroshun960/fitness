@extends('layouts.app')
@section('content')

@if (Auth::check())


<a class="backBtn arrow arrow--right" href="{{URL::to('/daily')}}"></a>


<style>

    .item{
        margin-bottom: 10px;
    }

</style>


<div class="daypage__hidden">



    <h2 class="mealssetting__title">{{ $day }}の食事内容</h2>


    @if ( isset($eatmeals[0]) || isset($protaintasks[0]) || isset($eatmeals[0],$protaintasks[0])  )


    <div class="daypage__scroll">
        <div class="daypage_meallist">

                    <div class="daypage_meallist__rows__title daypage_meallist__rows" style='display: flex;'>
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
                            <p>{{ $eatmeal->eatKcal }}<span class="phone__display__none">kcal</span></p>
                            <p>{{ $eatmeal->eatProtain }}<span class="phone__display__none">p</span></p>
                            <p>{{ $eatmeal->eatFat }}<span class="phone__display__none">f</span></p>
                            <p>{{ $eatmeal->eatCarbo }}<span class="phone__display__none">c</span></p>
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
                        <div class="daypage_protain__rows daypage_meallist__rows" style='display: flex;'>

                                    <p>プロテイン</p>
                                    <p>{{ $protaintask->kcal }}<span class="phone__display__none">kcal</span></p>
                                    <p>{{ $protaintask->protain }}<span class="phone__display__none">p</span></p>
                                    <p>{{ $protaintask->fat }}<span class="phone__display__none">f</span></p>
                                    <p>{{ $protaintask->carbo }}<span class="phone__display__none">c</span></p>
                                    <p>-</p>
                                    <p>-</p>
                        </div>
                    @endforeach




 
        </div>
    </div>

    <div class="daypage_nutritiondate">
        <div><p>総カロリー</p><p>{{ $nutdata['allKcal'] }} kcal</p></div>
        <div><p>総タンパク質</p><p>{{ $nutdata['allProtain'] }} P</p></div>
        <div><p>総脂質</p><p>{{ $nutdata['allFat'] }} F</p></div>
        <div><p>総炭水化物</p><p>{{ $nutdata['allCarbo'] }} C</p></div>
        <div><p>総費用</p><p>{{ $nutdata['allPrice'] }} 円</p></div>
    </div>



    @else

    <div class="dailypade__norecord">
        <p>記録はありません。</p>
    </div>

@endif




</div>



@endif

@endsection