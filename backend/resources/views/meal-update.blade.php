@extends('layouts.app')
@section('content')

@if (Auth::check())

<a href="{{URL::to('mealssetting')}}">もどる</a>

<?php

$url = url()->full();
$keys = parse_url($url); //パース処理
$path = explode("/", $keys['path']); //分割処理
$last = end($path); //最後の要素を取得

?> 





@if (count($errors) > 0)
<ul class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
        <li class="ml-4">{{ $error }}</li>
    @endforeach
</ul>
@endif


{!! Form::open( ['route' => ['mealssetting.update','id' => $last],'enctype'=>'multipart/form-data' ]) !!}
@csrf


    <p>種別</p>
    {{ Form::select('type',['食事'=> '食事' ,'飲料'=> '飲料' ,'おやつ'=> 'おやつ'], null, ['class' => 'form-control']) }}
    <br>

    <p>名前</p>
    {!! Form::text('name', $meal->name, ['class' => 'form-control','placeholder' => '']) !!}
    <br>

    @if( isset($meal->gram) )

    <style> .piece{display: none;}</style>
        
    <p>種別</p>
    {{ Form::select('',['gram'=> 'gram' ,'piece'=> 'piece'], 'gram', ['class' => 'form-control type']) }}
    <br class="">

    <p class="gram">内容量/g</p>
    {!! Form::text('gram', $meal->gram, ['class' => 'form-control gram','placeholder' => '','selected']) !!}
    <br class="gram">

    <p class="piece">内容量/個</p>
    {!! Form::text('piece', '', ['class' => 'form-control piece','placeholder' => '']) !!}
    <br class="piece">

    @elseif(isset($meal->piece))

    <style> .gram{display: none;}</style>

    <p>種別</p>
    {{ Form::select('',['gram'=> 'gram' ,'piece'=> 'piece'], 'piece', ['class' => 'form-control type']) }}
    <br>

    <p class="gram">内容量/g</p>
    {!! Form::text('gram', '', ['class' => 'form-control gram','placeholder' => '','selected']) !!}
    <br class="gram">

    <p class="piece">内容量/個</p>
    {!! Form::text('piece', $meal->piece, ['class' => 'form-control piece','placeholder' => '']) !!}
    <br class="piece">

    @endif

    {!! Form::label('file_name','プロフィール写真') !!}
    {!! Form::file('file_name') !!}
    <br>



    <p>価格を入力</p>
    {!! Form::text('price', $meal->price, ['class' => 'form-control','placeholder' => '']) !!}
    <br>
    <p>カロリーを入力</p>
    {!! Form::text('kcal', $meal->kcal, ['class' => 'form-control','placeholder' => '']) !!}
    <br>
    <p>タンパク質を入力</p>
    {!! Form::text('protain', $meal->protain, ['class' => 'form-control','placeholder' => '']) !!}
    <br>
    <p>炭水化物を入力</p>
    {!! Form::text('carbo', $meal->carbo, ['class' => 'form-control','placeholder' => '']) !!}
    <br>
    <p>脂質を入力</p>
    {!! Form::text('fat', $meal->fat, ['class' => 'form-control','placeholder' => '']) !!}
    <br>



<br>
{!! Form::submit('更新', ['class' => 'btn btn-primary btn-block','id']) !!}
{!! Form::close() !!}




{!! Form::open(['route' => ['meals.detroy','id' => $last],'method' => 'delete']) !!}
@csrf
<br>
{!! Form::submit('この商品を削除', ['class' => 'btn btn-primary btn-block']) !!}
{!! Form::close() !!}





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