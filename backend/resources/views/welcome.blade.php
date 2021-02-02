@extends('layouts.app')
@section('content')

@if (Auth::check())


@php
$todaydate = date("Y-m-d");
$i = 0;
date("Y年m月d日", strtotime("1 day"))
@endphp



{!! link_to_route('protainsettingpage','プロテイン設定',[],['class'=>'userRegistBtn']) !!}

{!! link_to_route('personalsettingspage.show','パーソナル設定',[],['class'=>'userRegistBtn']) !!}

{!! link_to_route('mealssetting.show','食品リスト',[],['class'=>'userRegistBtn']) !!}

<a href="{{ url('daily', $parameters = $todaydate, $secure = null) }}">今日</a>

    <br>
    <br>

    <p>適正体重:{{ $data['fitWeightFloor'] }}</p>
    <p>基礎代謝:{{ $data['baseEnergy'] }}</p>
    <p>必要カロリー:{{ $data['needEnergy'] }}</p>
    <br>

    <p>目標カロリーまで:{{ $data['kcalPardayToGoal'] }}</p>
    <p>目標タンパク質まで:{{ $data['protainPardayToGoal'] }}</p>
    <p>目標脂質まで:{{ $data['fatPardayCeilToGoal'] }}</p>
    <p>目標炭水化物まで:{{ $data['carboPardayCeilToGoal'] }}</p>

    <br>
    
    <a href="{{URL::to('daily/'.date("y-m-d", strtotime("today")) )}} "><p style="color: rgb(255, 55, 55)";>今日 : {{ $data['sumKcal1']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("y-m-d", strtotime("-1 day")) )}} "><p>{{date('m/d', strtotime('-1 day'))}} : {{ $data['sumKcal2']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("y-m-d", strtotime("-2 day")) )}} "><p>{{date('m/d', strtotime('-2 day'))}} : {{ $data['sumKcal3']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("y-m-d", strtotime("-3 day")) )}} "><p>{{date('m/d', strtotime('-3 day'))}} :{{ $data['sumKcal4']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("y-m-d", strtotime("-4 day")) )}} "><p>{{date('m/d', strtotime('-4 day'))}} :{{ $data['sumKcal5']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("y-m-d", strtotime("-5 day")) )}} "><p>{{date('m/d', strtotime('-5 day'))}} :{{ $data['sumKcal6']['kcal'] }}</p></a>
    <a href="{{URL::to('daily/'.date("y-m-d", strtotime("-6 day")) )}} "><p>{{date('m/d', strtotime('-6 day'))}} :{{ $data['sumKcal7']['kcal'] }}</p></a>




    {!! link_to_route('users.daily','日誌',[],['class'=>'userRegistBtn']) !!}





    {{-- 今朝の体重を測定 --}}
    <div class="todayWeight">
        <div class="measurement__inner">
            <div class=""></div>

            

            {{-- 今朝の体重を測定”済み”であれば、体重測定フォームは表示しない --}}
            @if (!isset( $data['weight']->weight ))
            {!! Form::open(['route' => 'weight.input']) !!}
                @csrf
                
                <p>今朝の体重は何kgでしたか？</p>
                
                {!! Form::text('number', old(''), ['class' => 'form-control','placeholder' => '体重を入力']) !!}
                <br>
        
                <p>kg</p>
        
                <br>
                {!! Form::submit('測った', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
            @endif

        </div>
    </div>



    <style>
        .topMealsList__Box{
            width :100px;
            height :100px;
            background-color: rgb(199, 199, 199);
            font-size: 5px;
            text-align: center;
            line-height: 100px;
            border-radius: 5px;
            margin: 10px 5px 8px;
        }

        .topMealsList__container{
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .net{
            width: 100px;
        }

        .topMealsList__Box__radio{
            display: none;
        }

        .topMealsList__input{
            display: none;
            justify-content: space-between;
            
        }

        .checked{
            color: rgb(255, 55, 55);
        }

        .eatBtn{
            width :300px;
            background-color: rgb(116, 176, 176);
        }


        .mealtype__meal{
            display: flex;
        }

        .mealtype__snack{
            display: none;
        }

        .mealtype__drink{
            display: none;
        }

    </style>


    {{-- 食べたものをチェック --}}
    <div class="topMealsList">
        <div class="topMealsList__innner" style="width:880px; margin: 0 auto;">

            <p style="text-align: center">今日食べたものをチェック！</p>

            <div class=""></div>



            {!! Form::open(['route' => 'eats']) !!}

            {!! Form::radio('eatmeal', 1, false, ['id' => 1,'class' => 'topMealsList__Box__radio']) !!}
            {!! Form::label(1,'食事', ['class' => 'mealtype__meal__tab checked']) !!}

            {!! Form::radio('eatmeal', 2, false, ['id' => 2,'class' => 'topMealsList__Box__radio']) !!}
            {!! Form::label(2,'おやつ', ['class' => 'mealtype__snack__tab']) !!}

            {!! Form::radio('eatmeal', 3, false, ['id' => 1,'class' => 'topMealsList__Box__radio']) !!}
            {!! Form::label(3,'飲み物', ['class' => 'mealtype__drink__tab']) !!}

            <div class="topMealsList__container mealtype__meal">
            @foreach ( $data['mealslists'] as $mealslist)
                @if ( $mealslist['type'] === '食事')
                {!! Form::radio('eatmeal', $mealslist->id, false, ['id' => $mealslist->id,'class' => 'topMealsList__Box__radio']) !!}
                {!! Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$mealslist->id]) !!}
                @endif
            @endforeach
            </div>

            <div class="topMealsList__container mealtype__snack">
                @foreach ( $data['mealslists'] as $mealslist)
                    @if ( $mealslist['type'] === 'おやつ')
                    {!! Form::radio('eatmeal', $mealslist->id, false, ['id' => $mealslist->id,'class' => 'topMealsList__Box__radio']) !!}
                    {!! Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$mealslist->id]) !!}
                    @endif
                @endforeach
            </div>

            <div class="topMealsList__container mealtype__drink">
                @foreach ( $data['mealslists'] as $mealslist)
                    @if ( $mealslist['type'] === '飲料')
                    {!! Form::radio('eatmeal', $mealslist->id, false, ['id' => $mealslist->id,'class' => 'topMealsList__Box__radio']) !!}
                    {!! Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$mealslist->id]) !!}
                    @endif
                @endforeach
            </div>



            <div class="topMealsList__input">
                <div style="display: flex;">
                    <p><span class="mealname"></span> / 摂取量</p>
                    {!! Form::text('net', '', ['class' => 'net','placeholder' => '']) !!}
                </div>
                <div>
                    {!! Form::submit('食べた！', ['class' => 'btn  eatBtn']) !!}
                </div>
            </div>

            {!! Form::close() !!}
            <br>

            </div>

    

        </div>
    </div>




    {{-- プロテイン設定が設定されていれば表示 --}}
    @if( count( Auth::user()->protainsetting()->get() ) >= 1 )

        {{-- 今日のプロテインタスクチェック --}}
        <div class="todayProtain">
            <div class="todayProtain__inner" style="width: 400px;margin: 150px auto 0;">

                {{-- プロテインタスクが３つとも達成されていなければ --}}
                @if( count( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->get() ) <= 2 )
                <p>今日のプロテインをチェック！</p>
                @endif

            </div>

            <div class="todayProtain__tasks" style="width:500px;margin:0 auto;">
                <div class="todayProtain__tasks__inner" style="display: flex;justify-content: space-between;">
                    
                    {{-- プロテインタスクが達成数０の場合 --}}
                    @if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->first() === null)
                    <div class="todayProtaintask a">
                        {!! Form::open(['route' => 'protaintasks.drank']) !!}
                            @csrf
            
                            {!! Form::submit('飲んだ!', ['name' => 'firstcup','class' => 'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                    @endif
                    
                    {{-- プロテインタスクが達成数1の場合 --}}
                    @if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->skip(1)->first() === null)
                    <div class="todayProtaintask b">
                        {!! Form::open(['route' => 'protaintasks.drank']) !!}
                            @csrf
            
                            {!! Form::submit('飲んだ!', ['name' => 'secondcup','class' => 'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                    @endif

                    {{-- プロテインタスクが達成数2の場合 --}}
                    @if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->skip(2)->first() === null)
                    <div class="todayProtaintask c">
                        {!! Form::open(['route' => 'protaintasks.drank']) !!}
                            @csrf
            
                            {!! Form::submit('飲んだ!', ['name' => 'thirdcup','class' => 'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                    @endif
                    

                </div>
            </div>
        </div>

    @endif




    {!! Form::open(['route' => 'mealssetting.setting']) !!}
    @csrf
    
    
    <p>種別</p>
    {{ Form::select('type',['食事'=> '食事' ,'飲料'=> '飲料' ,'おやつ'=> 'おやつ'], null, ['class' => 'form-control']) }}
    <br>

    <p>名前</p>
    {!! Form::text('name', '', ['class' => 'form-control','placeholder' => '']) !!}
    <br>

    <p>種別</p>
    {{ Form::select('',['gram'=> 'gram' ,'piece'=> 'piece'], 'gram', ['class' => 'form-control type']) }}
    <br>

    <p class="gram">内容量/g</p>
    {!! Form::text('gram', '', ['class' => 'form-control gram','placeholder' => '','selected']) !!}
    <br>

    <p class="piece">内容量/個</p>
    {!! Form::text('piece', '', ['class' => 'form-control piece','placeholder' => '']) !!}
    <br>

    <p>価格を入力</p>
    {!! Form::text('price', '', ['class' => 'form-control','placeholder' => '']) !!}
    <br>
    <p>カロリーを入力</p>
    {!! Form::text('kcal', '', ['class' => 'form-control','placeholder' => '']) !!}
    <br>
    <p>タンパク質を入力</p>
    {!! Form::text('protain', '', ['class' => 'form-control','placeholder' => '']) !!}
    <br>
    <p>炭水化物を入力</p>
    {!! Form::text('carbo', '', ['class' => 'form-control','placeholder' => '']) !!}
    <br>
    <p>脂質を入力</p>
    {!! Form::text('fat', '', ['class' => 'form-control','placeholder' => '']) !!}
    <br>

    
    <br>
    {!! Form::submit('設定', ['class' => 'btn btn-primary btn-block']) !!}
    {!! Form::close() !!}


    <style>
        .piece{
            display: none;
        }
    </style>

    <script>
    $(".type").change(function() {
        var type_val = $(".type").val();
            if(type_val == "gram") {
                $('.gram').css('display', 'block');
                $('.piece').css('display', 'none').val(null).val();
            }if(type_val == "piece") {
                $('.gram').css('display', 'none').val(null).val();
                $('.piece').css('display', 'block');
        }
    });


    
    $('.topMealsList__Box').click(function(){  

        var val = $(this).attr('id');
        var mealname = $(this).text();
        
        $('.topMealsList__input').css('display', 'flex');

        $(this).addClass('checked');

        $('.checked').not(this).removeClass('checked');
        
        console.log(mealname);

        $('.mealname').html(mealname);

    });

    $('.mealtype__meal__tab').click(function(){  
        $('.mealtype__meal').css('display','flex');
        $('.mealtype__snack').css('display','none');
        $('.mealtype__drink').css('display','none');

        $(this).addClass('checked');
        $('.checked').not(this).removeClass('checked');

    });

    $('.mealtype__snack__tab').click(function(){  
        $('.mealtype__snack').css('display','flex');
        $('.mealtype__meal').css('display','none');
        $('.mealtype__drink').css('display','none');

        $(this).addClass('checked');
        $('.checked').not(this).removeClass('checked');

    });

    $('.mealtype__drink__tab').click(function(){  
        $('.mealtype__drink').css('display','flex');
        $('.mealtype__snack').css('display','none');
        $('.mealtype__meal').css('display','none');

        $(this).addClass('checked');
        $('.checked').not(this).removeClass('checked');

    });



  
    </script>



@endif

@endsection