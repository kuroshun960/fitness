@extends('layouts.app')
@section('content')

@if (Auth::check())


{{-- 今日の日付取得 --}}
@php
$todaydate = date("Y-m-d");
$i = 0;
date("Y年m月d日", strtotime("1 day"))


@endphp



    <!---
    <div class="settingMenu">
        <div class="settingMenu__inner">
        <div>{!! link_to_route('protainsettingpage','プロテイン設定',[],['class'=>'userRegistBtn']) !!}</div>
        <div>{!! link_to_route('personalsettingspage.show','パーソナル設定',[],['class'=>'userRegistBtn']) !!}</div>
        <div>{!! link_to_route('mealssetting.show','食品リスト',[],['class'=>'userRegistBtn']) !!}</div>
        <div>{!! link_to_route('logout.get', 'Logout', [], ['class' => '']) !!}</div>
        </div>
    </div>
    -->


        <!----バリデーション---->
        @if (count($errors) > 0)
        <ul class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <li class="ml-4">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!---------------------------------------------------------------
        ユーザーの栄養情報セクション
    ----------------------------------------------------------------->


    @php

        if( filter_var($data['kcalPardayToGoal']) ){
            $cdcdcd = 0;
        }else{
            $cdcdcd = $data['kcalPardayToGoal'];
        }

    @endphp





    <div class="userStatus">
        <div class="status_background">

                    <div class="userSettingAlert"> 
                        @if (! isset( Auth::user()->height) )
                            <div class="">{!! link_to_route('personalsettingspage.show','身長・体重・運動量を登録しましょう。',[],['class'=>'userSettingAlert__personal']) !!}</div>   
                        @endif
                        @if (! isset($data['regist_protain']) )
                            <div class="">{!! link_to_route('protainsettingpage','飲んでいるプロテインを設定しましょう。',[],['class'=>'userSettingAlert__protain']) !!}</div>
                        @endif
                        @if (! isset($data['mealslists'][0]) )
                            <div><a href="#mealFrom" class="userSettingAlert__meal">食生活を記録する為の食品を登録しましょう</a></div>
                        @endif
                    </div>

                <div class="userStatus__inner">


                    {{-- 摂取栄養素情報 --}}
                    <div class="userStatus__inner__nut">
                        <div class="userStatus__inner__kcal">
                            <div>
                                {{-- 三項演算子 ? : 多次元配列--}}
                                <p>摂取カロリー/日目標</p>
                                <p><span>{{ isset($data['sumKcal1']) ? number_format($data['sumKcal1']['kcal']):0 }}</span><span class="slash">/</span><span>{{ number_format(Auth::user()->kcalParday) }}kcal</span></p>
                            </div>

                            <div>
                                <p>目標まで残り</p>
                                <p><span>{{ number_format($cdcdcd) }}</span><span>kcal</span></p>
                            </div>
                        </div>

                        <div class="userStatus__inner__pfc">
                            <div class="userStatus__inner__pfc__icon">摂取量とPFCバランス</div>
                            <div>
                                <div class="protainIcon"></div>
                                <p>タンパク質</p>
                                <p class="P_num"><span class="P">{{ isset($data['sumKcal1']) ? $data['sumKcal1']['protain']:0 }}</span><span class="slash">/</span><span>{{ isset($data['parprotain']) ? $data['parprotain'] : 0 }}P</span></p>
                            </div>

                            <div>
                                <div class="fatIcon"></div>
                                <p>脂質</p>
                                <p class="F_num"><span class="F">{{ isset($data['sumKcal1']) ? $data['sumKcal1']['fat']:0 }}</span><span class="slash">/</span><span>{{ isset($data['parfat']) ? $data['parfat'] : 0 }}F</span></p>
                            </div>

                            <div>
                                <div class="carboIcon"></div>
                                <p>炭水化物</p>
                                <p class="C_num"><span class="C">{{ isset($data['sumKcal1']) ? $data['sumKcal1']['carbo']:0 }}</span><span class="slash">/</span><span>{{ isset($data['parcarbo']) ? $data['parcarbo'] : 0 }}C<span></p>
                            </div>
                        </div>
                    </div>

        
                                {{-- 男性か女性かで画像を分岐 --}}
                                @if (Auth::user()->sex === '男性')
                                    <div class="human">

                                    @switch(true)

                                        @case( 19 > $data['kcalParcent'] && $data['kcalParcent'] > 10 )                    
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_10.png" alt="">
                                        @break
                                        @case( 29 > $data['kcalParcent'] && $data['kcalParcent'] >= 19 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_20.png" alt="">
                                        @break
                                        @case( 39 > $data['kcalParcent'] && $data['kcalParcent'] >= 30 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_30.png" alt="">
                                        @break
                                        @case( 49 > $data['kcalParcent'] && $data['kcalParcent'] >= 40 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_40.png" alt="">
                                        @break
                                        @case( 59 > $data['kcalParcent'] && $data['kcalParcent'] >= 50 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_50.png" alt="">
                                        @break
                                        @case( 69 > $data['kcalParcent'] && $data['kcalParcent'] >= 60 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_60.png" alt="">
                                        @break
                                        @case( 79 > $data['kcalParcent'] && $data['kcalParcent'] >= 70 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_70.png" alt="">
                                        @break
                                        @case( 89 > $data['kcalParcent'] && $data['kcalParcent'] >= 80 )
                                       <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_80.png" alt="">
                                        @break
                                        @case( 99 > $data['kcalParcent'] && $data['kcalParcent'] >= 90 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_90.png" alt="">
                                        @break
                                        @case( $data['kcalParcent'] >= 99 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_100.png" alt="">
                                        @break                            

                                        @default
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men_0.png" alt=""> 
                                    @endswitch
                                    
                                    </div>
                                @else
                                <div class="human">

                                    @switch(true)

                                        @case( 19 > $data['kcalParcent'] && $data['kcalParcent'] > 10 )                    
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_10.png" alt="">
                                        @break
                                        @case( 29 > $data['kcalParcent'] && $data['kcalParcent'] >= 19 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_20.png" alt="">
                                        @break
                                        @case( 39 > $data['kcalParcent'] && $data['kcalParcent'] >= 30 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_30.png" alt="">
                                        @break
                                        @case( 49 > $data['kcalParcent'] && $data['kcalParcent'] >= 40 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_40.png" alt="">
                                        @break
                                        @case( 59 > $data['kcalParcent'] && $data['kcalParcent'] >= 50 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_50.png" alt="">
                                        @break
                                        @case( 69 > $data['kcalParcent'] && $data['kcalParcent'] >= 60 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_60.png" alt="">
                                        @break
                                        @case( 79 > $data['kcalParcent'] && $data['kcalParcent'] >= 70 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_70.png" alt="">
                                        @break
                                        @case( 89 > $data['kcalParcent'] && $data['kcalParcent'] >= 80 )
                                       <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_80.png" alt="">
                                        @break
                                        @case( 99 > $data['kcalParcent'] && $data['kcalParcent'] >= 90 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_90.png" alt="">
                                        @break
                                        @case( $data['kcalParcent'] >= 99 )
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_100.png" alt="">
                                        @break                            

                                        @default
                                        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women_0.png" alt=""> 
                                    @endswitch
                                    
                                    </div>
                                    
                                @endif




                            {{-- 体重情報 --}}
                            <div class="userStatus__inner__metabo">
                                <div class="userStatus__weight">
                                    @if(isset( $data['weight']->weight))
                                    <div><p>現在の体重</p><p class="weight">{{ $data['weight']->weight }}<span>kg</span></p></div>
                                    @else
                                    <div><p>現在の体重</p><p class="weight">--<span>kg</span></p></div>
                                    @endif
                                    <p class="userStatus__weight__week">7日前より{{ $data['weights7daysagoCompare'] }}kg</p>
                                </div>
                                <div class="userStatus__metabo">
                                    <div><p>適正体重</p><p>{{ $data['fitWeightFloor'] }}kg</p></div>
                                    <div><p>基礎代謝</p><p>{{ $data['baseEnergy'] }}kcal</p></div>
                                    <div><p>消費カロリー</p><p>{{ $data['needEnergy'] }}kcal</p></div>
                                </div>
                            </div>




            
                </div>
            </div>
        </div>


    <!--
    <p>目標タンパク質まで:{{ $data['protainPardayToGoal'] }}</p>
    <p>目標脂質まで:{{ $data['fatPardayCeilToGoal'] }}</p>
    <p>目標炭水化物まで:{{ $data['carboPardayCeilToGoal'] }}</p>
    -->
        
    <!--
    <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("today")) )}} "><p style="color: rgb(255, 55, 55)";>今日 : {{ $data['sumKcal1']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-1 day")) )}} "><p>{{date('m/d', strtotime('-1 day'))}} : {{ $data['sumKcal2']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-2 day")) )}} "><p>{{date('m/d', strtotime('-2 day'))}} : {{ $data['sumKcal3']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-3 day")) )}} "><p>{{date('m/d', strtotime('-3 day'))}} :{{ $data['sumKcal4']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-4 day")) )}} "><p>{{date('m/d', strtotime('-4 day'))}} :{{ $data['sumKcal5']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-5 day")) )}} "><p>{{date('m/d', strtotime('-5 day'))}} :{{ $data['sumKcal6']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-6 day")) )}} "><p>{{date('m/d', strtotime('-6 day'))}} :{{ $data['sumKcal7']['kcal'] }}</p></a>
    -->






    <!---------------------------------------------------------------
        「体重を測定しよう」セクション
    ----------------------------------------------------------------->
    
    
    {{--新規ユーザーなど、最新の体重データがそもそもない場合、$latestWeight_dateには00-00-00を代入--}}
    {{--既存ユーザーには、最新の体重データの日付型を、$latestWeight_dateに代入--}}
    @php
        if (isset($data['weight'])){
            $latestWeight = $data['weight']->created_at;
            $latestWeight_date = $latestWeight->format('Y-m-d');
        }else {
            $latestWeight_date = "00-00-00";
        }
    @endphp


 
    {{--もし、渡されている最新の体重データが、今日の日付のモノじゃなかったら体重測定フォームを表示--}}
    @if ( $latestWeight_date !== $todaydate )
        {{-- 今朝の体重を測定 --}}
        <div class="todayWeight">
            <div class="todayWeight__inner">
                {{-- 今朝の体重を測定”済み”であれば、体重測定フォームは表示しない --}}
                {!! Form::open(['route' => 'weight.input','class'=>'todayWeight__form']) !!} @csrf
                    
                    <p>今朝の体重を記録しましょう。</p>
                    <div class="todayWeightFrom">{!! Form::text('weight', old(''), ['class' => 'todayWeight__form-control todayWeight_number form','placeholder' => '今日の体重を入力']) !!}<div>kg</div></div>
                    
                    <div class="todayWeightSubmit">{!! Form::submit('記録', ['class' => 'todayWeight__form-control submit']) !!}</div>

                {!! Form::close() !!}
            </div>
        </div>
    @endif





    <!---------------------------------------------------------------
        「今日食べたものをチェック！」セクション
    ----------------------------------------------------------------->

    <div class="topMealsList">
        <div class="topMealsList__inner">

            <p>今日食べたものをチェック！</p>

            {!! Form::open(['route' => 'eats']) !!}

            <div class="topMealsList__group">
            {!! Form::radio('eatmeal', 1, false, ['id' => 1,'class' => 'topMealsList__Box__radio']) !!}
            {!! Form::label(1,'食事', ['class' => 'mealtype__meal__tab isActive' ]) !!}

            {!! Form::radio('eatmeal', 2, false, ['id' => 2,'class' => 'topMealsList__Box__radio']) !!}
            {!! Form::label(2,'おやつ', ['class' => 'mealtype__snack__tab']) !!}

            {!! Form::radio('eatmeal', 3, false, ['id' => 1,'class' => 'topMealsList__Box__radio']) !!}
            {!! Form::label(3,'飲み物', ['class' => 'mealtype__drink__tab']) !!}
            </div>
        <hr class="topMealsList__group__hr">
        

            @php
                $userid = Auth::id();
                $isset_type_meal = DB::select(" SELECT * FROM meals WHERE type='食事' AND user_id=$userid ");
                $isset_type_snack = DB::select(" SELECT * FROM meals WHERE type='おやつ' AND user_id=$userid ");
                $isset_type_drink = DB::select(" SELECT * FROM meals WHERE type='飲料' AND user_id=$userid ");
            @endphp


            <div class="topMealsList__container mealtype__meal">
                @if( count( $isset_type_meal ) === 0 )
                <div class="meals__noset">
                    <p>登録した食品はこちらに登録されます。</p>
                </div>
                @endif

                @foreach ( $data['mealslists'] as $mealslist)
                    @if (isset($mealslist->gram))<?php $net = 'g' ?>@elseif (isset($mealslist->piece))<?php $net = '個' ?>@endif
                    @if ( $mealslist['type'] === '食事')

                        {!! Form::radio('eatmeal', $mealslist->id, false, ['id' => $mealslist->id,'class' => 'topMealsList__Box__radio']) !!}
                        {{-- 商品写真がある場合は 写真 を表示 --}}
                        @if (isset($mealslist->item_photo_path)){!! Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' itemImage' ,'style'=>'background-image: url("'.$mealslist->item_photo_path.'");']) !!}
                        {{-- 商品写真がない場合は 商品名 を表示 --}}
                        @else{!! Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' noItemImage']) !!}
                        @endif

                    @endif
                @endforeach
            </div>

            <div class="topMealsList__container mealtype__snack">

                @if( count( $isset_type_snack ) === 0 )
                <div class="meals__noset"><p>登録した食品はこちらに登録されます。</p></div>
                
                @endif

                @foreach ( $data['mealslists'] as $mealslist)

                    @if (isset($mealslist->gram))<?php $net = 'g' ?>@elseif (isset($mealslist->piece))<?php $net = '個' ?>@endif
                    @if ( $mealslist['type'] === 'おやつ')
                        {!! Form::radio('eatmeal', $mealslist->id, false, ['id' => $mealslist->id,'class' => 'topMealsList__Box__radio']) !!}
                        @if (isset($mealslist->item_photo_path)){!! Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' itemImage' ,'style'=>'background-image: url("'.$mealslist->item_photo_path.'");']) !!}
                        @else{!! Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' noItemImage']) !!}
                        @endif
                    @endif
                @endforeach
            </div>

            <div class="topMealsList__container mealtype__drink">

                @if( count( $isset_type_drink ) === 0 )
                <div class="meals__noset"><p>登録した食品はこちらに登録されます。</p></div>
                @endif
                
                @foreach ( $data['mealslists'] as $mealslist)

                    @if (isset($mealslist->gram))<?php $net = 'g' ?>@elseif (isset($mealslist->piece))<?php $net = '個' ?>@endif
                    @if ( $mealslist['type'] === '飲料')
                        {!! Form::radio('eatmeal', $mealslist->id, false, ['id' => $mealslist->id,'class' => 'topMealsList__Box__radio']) !!}
                        @if (isset($mealslist->item_photo_path)){!! Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' itemImage' ,'style'=>'background-image: url("'.$mealslist->item_photo_path.'");']) !!}
                        @else{!! Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' noItemImage']) !!}
                        @endif
                    @endif
                @endforeach
            </div>




            <div class="topMealsList__input">
                <p><span class="mealname"></span></p>
                <div class="topMealsList__net">
                    <div>{!! Form::text('net', '', ['class' => 'eatnet','placeholder' => '摂取量']) !!}</div>
                    <p><span class="mealnettype"></span></p>
                    <div>{!! Form::submit('食べた！', ['class' => 'btn  eatBtn']) !!}</div>
                </div>
            </div>

            {!! Form::close() !!}
            <br>

            

        </div>
    </div>






    <!---------------------------------------------------------------
        プロテインタスク セクション
    ----------------------------------------------------------------->

    {{-- プロテイン設定が設定されていれば表示 --}}
    <div class="todayProtain">
    @if( count( Auth::user()->protainsetting()->get() ) >= 1 )

        {{-- プロテインタスクが３つとも達成されていなければ --}}
        @if( count( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->get() ) <= 2 )
        <p>今日のプロテインをチェック！</p>
        @else<p>今日のプロテインは全て飲み終えました</p>
        @endif
        {{-- 今日のプロテインタスクチェック --}}

            <div class="todayProtain__tasks">
                <div class="todayProtain__tasks__inner">
                    
                    {{-- プロテインタスクが達成数０の場合 --}}
                    <div class="a">
                        {!! Form::open(['route' => 'protaintasks.drank']) !!}
                        @csrf
                        
                        @if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->first() === null)
                            {!! Form::submit('飲んだ!', ['name' => 'firstcup','class' => 'todayProtaintask']) !!}
                        @else <div class="todayProtaintask__done"></div>
                        @endif
                            
                        {!! Form::close() !!}
                    </div>


                    
                    {{-- プロテインタスクが達成数1の場合 --}}
                    <div class="b">
                        {!! Form::open(['route' => 'protaintasks.drank']) !!}
                        @csrf

                        @if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->first() === null)
                                <div class="todayProtaintask__missorder">飲んだ</div>
                        @else
                            @if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->skip(1)->first() === null)
                                {!! Form::submit('飲んだ!', ['name' => 'secondcup','class' => 'todayProtaintask']) !!}
                            @else <div class="todayProtaintask__done"></div>
                            @endif
                        @endif

                        {!! Form::close() !!}
                    </div>
                    

                    {{-- プロテインタスクが達成数2の場合 --}}
                    <div class="c">
                        {!! Form::open(['route' => 'protaintasks.drank']) !!}
                        @csrf
                        

                        @if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->skip(1)->first() === null)
                                <div class="todayProtaintask__missorder">飲んだ</div>
                        @else
                            @if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->skip(2)->first() === null)
                                {!! Form::submit('飲んだ!', ['name' => 'secondcup','class' => 'todayProtaintask']) !!}
                            @else <div class="todayProtaintask__done"></div>
                            @endif
                        @endif

                        {!! Form::close() !!}
                    </div>
                    

                </div>

                <div class="regist_protain">
                    登録プロテイン : {{ $data['regist_protain']->name }}
                </div>
            </div>

    @else

    <div class="protainsetteing__noset">
        <p>プロテインをお飲みの方は、<br class="phone__br">{!! link_to_route('protainsettingpage','プロテイン設定',[],['class'=>'']) !!} をしましょう。</p>
    </div>
    
    @endif






    <!---------------------------------------------------------------
        デイリーグラフ＆日誌 セクション
    ----------------------------------------------------------------->

    <div class="daily">
        <div class="dayContainer">
            <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-6 day")) )}} ">
                <div class="dayBox _6">{{ $data['sumKcal7']['kcal'] }}<span>kcal</span></div>
                    {{-- プロテインタスクが達成数2の場合 --}}
                    @php $sumKcal7parGoal = $data['sumKcal7']['kcal']/ Auth::user()->kcalParday *100;@endphp
                <div class="date">{{date('m/d', strtotime('-6 day'))}}</div>
            </a>
        </div>
        <div class="dayContainer">
            <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-5 day")) )}} ">
                <div class="dayBox _5">{{ $data['sumKcal6']['kcal'] }}<span>kcal</span></div>
                    {{-- プロテインタスクが達成数2の場合 --}}
                    @php $sumKcal6parGoal = $data['sumKcal6']['kcal']/Auth::user()->kcalParday*100;@endphp
                <div class="date">{{date('m/d', strtotime('-5 day'))}}</div>
            </a>
        </div>
        <div class="dayContainer">
            <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-4 day")) )}} ">
                <div class="dayBox _4">{{ $data['sumKcal5']['kcal'] }}<span>kcal</span></div>
                    {{-- プロテインタスクが達成数2の場合 --}}
                    @php $sumKcal5parGoal = $data['sumKcal5']['kcal']/Auth::user()->kcalParday*100;@endphp
                <div class="date">{{date('m/d', strtotime('-4 day'))}}</div>
            </a>
        </div>
        <div class="dayContainer">
            <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-3 day")) )}} ">
                <div class="dayBox _3">{{ $data['sumKcal4']['kcal'] }}<span>kcal</span></div>
                    {{-- プロテインタスクが達成数2の場合 --}}
                    @php $sumKcal4parGoal = $data['sumKcal4']['kcal']/Auth::user()->kcalParday*100;@endphp
                <div class="date">{{date('m/d', strtotime('-3 day'))}}</div>
            </a>
        </div>
        <div class="dayContainer">
            <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-2 day")) )}} ">
                <div class="dayBox _2">{{ $data['sumKcal3']['kcal'] }}<span>kcal</span></div>
                    {{-- プロテインタスクが達成数2の場合 --}}    
                    @php $sumKcal3parGoal = $data['sumKcal3']['kcal']/Auth::user()->kcalParday*100;@endphp
                <div class="date">{{date('m/d', strtotime('-2 day'))}}</div>
            </a>
        </div>

        <div class="dayContainer">
            <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("-1 day")) )}} ">
                <div class="dayBox _1">{{ $data['sumKcal2']['kcal'] }}<span>kcal</span></div>
                    {{-- プロテインタスクが達成数2の場合 --}}    
                    @php $sumKcal2parGoal = $data['sumKcal2']['kcal']/Auth::user()->kcalParday*100;@endphp
                <div class="date">{{date('m/d', strtotime('-1 day'))}}</div>
            </a>
        </div>

        <div class="dayContainer__today">
            <a href="{{URL::to('daily/'.date("Y-m-d", strtotime("today")) )}} ">
                <div class="dayBox__today">{{ $data['sumKcal1']['kcal'] }}<span>kcal</span></div>
                    {{-- プロテインタスクが達成数2の場合 --}}
                    @php $sumKcal1parGoal = $data['sumKcal1']['kcal']/Auth::user()->kcalParday*100;@endphp
                <div class="date__today">今日</div>
            </a>
        </div>
    </div>


    {!! link_to_route('users.daily','日誌',[],['class'=>'dailyBtn']) !!}

    </div>






    <!---------------------------------------------------------------
        食品登録セクション
    ----------------------------------------------------------------->




    <div class="mealFrom" id="mealFrom">
        <div class="mealFrom__inner">

        <p>食品を登録する</p>

        {!! Form::open(['route' => 'mealssetting.setting','enctype'=>'multipart/form-data']) !!}
        @csrf
        
        <div>
        <p>種別</p>
        {{ Form::select('type',['食事'=> '食事' ,'飲料'=> '飲料' ,'おやつ'=> 'おやつ'], null, ['class' => 'meal-form']) }}
        </div>

        <div>
        <p>食名</p>
        {!! Form::text('name', '', ['class' => 'meal-form','placeholder' => '']) !!}
        </div>

        <div>
        <p>内容量単位</p>
        {{ Form::select('',['gram'=> 'グラム' ,'piece'=> '個数'], 'gram', ['class' => 'meal-form type']) }}
        </div>

        <div class="gram">
        <p class="">内容量</p>
        {!! Form::text('gram', '', ['class' => 'meal-form gram','placeholder' => '','selected']) !!}
        <p class="">g</p>
        </div>
        
        <div class="piece">
        <p class="">内容量</p>
        {!! Form::text('piece', '', ['class' => 'meal-form piece','placeholder' => '']) !!}
        <p class="">個</p>
        </div>

        <div>
        <p>価格</p>
        {!! Form::text('price', '', ['class' => 'meal-form','placeholder' => '']) !!}
        <p>円</p>
        </div>

        <div>
        <p>カロリー</p>
        {!! Form::text('kcal', '', ['class' => 'meal-form','placeholder' => '']) !!}
        <p>kcal</p>
        </div>

        <div>
        <p>タンパク質</p>
        {!! Form::text('protain', '', ['class' => 'meal-form','placeholder' => '']) !!}
        </div>

        <div>
        <p>炭水化物</p>
        {!! Form::text('carbo', '', ['class' => 'meal-form','placeholder' => '']) !!}
        </div>

        <div>
        <p>脂質</p>
        {!! Form::text('fat', '', ['class' => 'meal-form','placeholder' => '']) !!}
        </div>

        <div>
        <p>写真</p>
        {!! Form::file('file_name', ['class' => 'filename__form','style' => 'margin-top: 0px']) !!}
        </div>
        
        <div class="">{!! Form::submit('登録する', ['class' => 'mealregist']) !!}</div>
        {!! Form::close() !!}

        </div>
    </div>






    <!---------------------------------------------------------------
        動的表現のスクリプト類
    ----------------------------------------------------------------->

    <!----”個数”の単位はデフォルトで非表示---->
    <style>
        .piece{display: none;}
    </style>


    <script>


    $(function(){

    $('.userSetting').click(function(){     
    $('.settingMenu').slideToggle(200);
    });

    //グラム、個数のフォームをセレクトで分岐
    $(".type").change(function() {
        var type_val = $(".type").val();
            if(type_val == "gram") {
                $('.gram').css('display', 'flex');
                $('.piece').css('display', 'none').val(null).val();
            }if(type_val == "piece") {
                $('.gram').css('display', 'none').val(null).val();
                $('.piece').css('display', 'flex');
        }
    });

    //商品をクリックすると摂取量入力画面を表示
    $('.topMealsList__Box').click(function(){  

        var val = $(this).attr('id');
        var mealname = $(this).text();
        var mealnettype = $(this).attr('class');
        var mealnettypes = mealnettype.split(' ');
        
        
        $('.topMealsList__input').show('display', 'flex');
        $(this).addClass('checked');
        $('.checked').not(this).removeClass('checked');

        $('.eatnet').css('display','block');
        $('.eatBtn').css('display','block');
        $('.mealname').html(mealname);
        $('.mealnettype').html(mealnettypes[1]);
    });

    //商品タイプ 食事
    $('.mealtype__meal__tab').click(function(){  
        setTimeout(function(){ $('.mealtype__meal').fadeIn(300).css('display','flex'); },300);
        $('.mealtype__snack').fadeOut(300);
        $('.mealtype__drink').fadeOut(300);

        $(this).addClass('isActive');
        $('.isActive').not(this).removeClass('isActive');
    });

    //商品タイプ おやつ
    $('.mealtype__snack__tab').click(function(){  
        setTimeout(function(){ $('.mealtype__snack').fadeIn(300).css('display','flex'); },300);
        $('.mealtype__meal').fadeOut(300);
        $('.mealtype__drink').fadeOut(300);
        $(this).addClass('isActive');
        $('.isActive').not(this).removeClass('isActive');

    });

    //商品タイプ 飲み物
    $('.mealtype__drink__tab').click(function(){  
        setTimeout(function(){ $('.mealtype__drink').fadeIn(300).css('display','flex'); },300);
        $('.mealtype__snack').fadeOut(300);
        $('.mealtype__meal').fadeOut(300);
        $(this).addClass('isActive');
        $('.isActive').not(this).removeClass('isActive');
    });






  /*----------------------------------------------------------------------------------------------
        日誌/日別摂取カロリーグラフ  摂取カロリーの合計が、目標カロリーに対して、何割なのかでCSSを分岐する処理
  ----------------------------------------------------------------------------------------------*/

        
    var sumKcal1parGoal = <?php echo$sumKcal1parGoal; ?> ;
    var sumKcal2parGoal = <?php echo$sumKcal2parGoal; ?> ;
    var sumKcal3parGoal = <?php echo$sumKcal3parGoal; ?> ;
    var sumKcal4parGoal = <?php echo$sumKcal4parGoal; ?> ;
    var sumKcal5parGoal = <?php echo$sumKcal5parGoal; ?> ;
    var sumKcal6parGoal = <?php echo$sumKcal6parGoal; ?> ;
    var sumKcal7parGoal = <?php echo$sumKcal7parGoal; ?> ;

    switch(true){
        case sumKcal1parGoal >= 90:
        $(".dayBox__today").css('height','300px')
        break;
        case sumKcal1parGoal >= 80:
        $(".dayBox__today").css('height','270px')
        break;
        case sumKcal1parGoal >= 70:
        $(".dayBox__today").css('height','240px')
        break;
        case sumKcal1parGoal >= 60:
        $(".dayBox__today").css('height','210px')
        break;
        case sumKcal1parGoal >= 50:
        $(".dayBox__today").css('height','180px')
        break;
        case sumKcal1parGoal >= 40:
        $(".dayBox__today").css('height','150px')
        break;
        case sumKcal1parGoal >= 30:
        $(".dayBox__today").css('height','120px')
        break;
        case sumKcal1parGoal >= 20:
        $(".dayBox__today").css('height','90px')
        break;
        case sumKcal1parGoal >= 10:
        $(".dayBox__today").css('height','60px')
        break;
        case sumKcal1parGoal >= 0:
        $(".dayBox__today").css('height','30px')
        $(".dayBox__today").css('padding','8px 5px 0')
        break;
    }

    switch(true){
        case sumKcal2parGoal >= 90:
        $("._1").css('height','300px')
        break;
        case sumKcal2parGoal >= 80:
        $("._1").css('height','270px')
        break;
        case sumKcal2parGoal >= 70:
        $("._1").css('height','240px')
        break;
        case sumKcal2parGoal >= 60:
        $("._1").css('height','210px')
        break;
        case sumKcal2parGoal >= 50:
        $("._1").css('height','180px')
        break;
        case sumKcal2parGoal >= 40:
        $("._1").css('height','150px')
        break;
        case sumKcal2parGoal >= 30:
        $("._1").css('height','120px')
        break;
        case sumKcal2parGoal >= 20:
        $("._1").css('height','90px')
        break;
        case sumKcal2parGoal >= 10:
        $("._1").css('height','60px')
        break;
        case sumKcal2parGoal >= 0:
        $("._1").css('height','30px')
        $("._1").css('padding','8px 0 0')
        break;
    }

    switch(true){
        case sumKcal3parGoal >= 90:
        $("._2").css('height','300px')
        break;
        case sumKcal3parGoal >= 80:
        $("._2").css('height','270px')
        break;
        case sumKcal3parGoal >= 70:
        $("._2").css('height','240px')
        break;
        case sumKcal3parGoal >= 60:
        $("._2").css('height','210px')
        break;
        case sumKcal3parGoal >= 50:
        $("._2").css('height','180px')
        break;
        case sumKcal3parGoal >= 40:
        $("._2").css('height','150px')
        break;
        case sumKcal3parGoal >= 30:
        $("._2").css('height','120px')
        break;
        case sumKcal3parGoal >= 20:
        $("._2").css('height','90px')
        break;
        case sumKcal3parGoal >= 10:
        $("._2").css('height','60px')
        break;
        case sumKcal3parGoal >= 0:
        $("._2").css('height','30px')
        $("._2").css('padding','8px 0 0')
        break;
    }

    switch(true){
        case sumKcal4parGoal >= 90:
        $("._3").css('height','300px')
        break;
        case sumKcal4parGoal >= 80:
        $("._3").css('height','270px')
        break;
        case sumKcal4parGoal >= 70:
        $("._3").css('height','240px')
        break;
        case sumKcal4parGoal >= 60:
        $("._3").css('height','210px')
        break;
        case sumKcal4parGoal >= 50:
        $("._3").css('height','180px')
        break;
        case sumKcal4parGoal >= 40:
        $("._3").css('height','150px')
        break;
        case sumKcal4parGoal >= 30:
        $("._3").css('height','120px')
        break;
        case sumKcal4parGoal >= 20:
        $("._3").css('height','90px')
        break;
        case sumKcal4parGoal >= 10:
        $("._3").css('height','60px')
        break;
        case sumKcal4parGoal >= 0:
        $("._3").css('height','30px')
        $("._3").css('padding','8px 0 ')
        break;
    }

    switch(true){
        case sumKcal5parGoal >= 90:
        $("._4").css('height','300px')
        break;
        case sumKcal5parGoal >= 80:
        $("._4").css('height','270px')
        break;
        case sumKcal5parGoal >= 70:
        $("._4").css('height','240px')
        break;
        case sumKcal5parGoal >= 60:
        $("._4").css('height','210px')
        break;
        case sumKcal5parGoal >= 50:
        $("._4").css('height','180px')
        break;
        case sumKcal5parGoal >= 40:
        $("._4").css('height','150px')
        break;
        case sumKcal5parGoal >= 30:
        $("._4").css('height','120px')
        break;
        case sumKcal5parGoal >= 20:
        $("._4").css('height','90px')
        break;
        case sumKcal5parGoal >= 10:
        $("._4").css('height','60px')
        break;
        case sumKcal5parGoal >= 0:
        $("._4").css('height','30px')
        $("._4").css('padding','8px 0 0')
        break;
    }

    switch(true){
        case sumKcal6parGoal >= 90:
        $("._5").css('height','300px')
        break;
        case sumKcal6parGoal >= 80:
        $("._5").css('height','270px')
        break;
        case sumKcal6parGoal >= 70:
        $("._5").css('height','240px')
        break;
        case sumKcal6parGoal >= 60:
        $("._5").css('height','210px')
        break;
        case sumKcal6parGoal >= 50:
        $("._5").css('height','180px')
        break;
        case sumKcal6parGoal >= 40:
        $("._5").css('height','150px')
        break;
        case sumKcal6parGoal >= 30:
        $("._5").css('height','120px')
        break;
        case sumKcal6parGoal >= 20:
        $("._5").css('height','90px')
        break;
        case sumKcal6parGoal >= 10:
        $("._5").css('height','60px')
        break;
        case sumKcal6parGoal >= 0:
        $("._5").css('height','30px')
        $("._5").css('padding','8px 0 0')
        break;
    }

    switch(true){
        case sumKcal7parGoal >= 90:
        $("._6").css('height','300px')
        break;
        case sumKcal7parGoal >= 80:
        $("._6").css('height','270px')
        break;
        case sumKcal7parGoal >= 70:
        $("._6").css('height','240px')
        break;
        case sumKcal7parGoal >= 60:
        $("._6").css('height','210px')
        break;
        case sumKcal7parGoal >= 50:
        $("._6").css('height','180px')
        break;
        case sumKcal7parGoal >= 40:
        $("._6").css('height','150px')
        break;
        case sumKcal7parGoal >= 30:
        $("._6").css('height','120px')
        break;
        case sumKcal7parGoal >= 20:
        $("._6").css('height','90px')
        break;
        case sumKcal7parGoal >= 10:
        $("._6").css('height','60px')
        break;
        case sumKcal7parGoal >= 0:
        $("._6").css('height','30px')
        $("._6").css('padding','8px 0 0')
        break;
    }







    });
    </script>



@endif

@endsection