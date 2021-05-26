@extends('layouts.app')
@section('content')

@if (Auth::check())

<a class="backBtn arrow arrow--right" href="{{URL::to('/mealssetting')}}"></a>
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


<style>
    .meal_update_mealname{
        text-align: center;
    }
</style>

<div class="protain_setting__container">

    
    <div class="meal_update_item_photo_path"><img src="{{ $meal->item_photo_path }}" width="100%" alt=""></div>

    <div class="meal_update_mealname"><p>{{ $meal->name }}</p></div>


    {!! Form::open( ['route' => ['mealssetting.update','id' => $last],'enctype'=>'multipart/form-data','class'=>'mealsupdate' ]) !!}
    @csrf


        <p>種別</p>
        {{ Form::select('type',['食事'=> '食事' ,'飲料'=> '飲料' ,'おやつ'=> 'おやつ'],$meal->type, ['class' => 'form-control']) }}
        

        <p>名前</p>
        {!! Form::text('name', $meal->name, ['class' => 'form-control','placeholder' => '']) !!}
        

        @if( isset($meal->gram) )

            <style> .piece{display: none;}</style>
                
            <p>種別</p>
            {{ Form::select('',['gramu '=> 'グラム' ,'piece'=> '個数'], 'gram', ['class' => 'form-control type']) }}

            <p class="gram">内容量/g</p>
            {!! Form::text('gram', $meal->gram, ['class' => 'form-control gram','placeholder' => '','selected']) !!}

            <p class="piece">内容量/個</p>
            {!! Form::text('piece', '', ['class' => 'form-control piece','placeholder' => '']) !!}

        @elseif(isset($meal->piece))

            <style> .gram{display: none;}</style>

            <p>種別</p>
            {{ Form::select('',['gram'=> 'gram' ,'piece'=> 'kosuu'], 'piece', ['class' => 'form-control type']) }}
            

            <p class="gram">内容量/g</p>
            {!! Form::text('gram', '', ['class' => 'form-control gram','placeholder' => '','selected']) !!}
            

            <p class="piece">内容量/個</p>
            {!! Form::text('piece', $meal->piece, ['class' => 'form-control piece','placeholder' => '']) !!}

        @endif


        <p>価格を入力</p>
        {!! Form::text('price', $meal->price, ['class' => 'form-control','placeholder' => '']) !!}
        
        <p>カロリーを入力</p>
        {!! Form::text('kcal', $meal->kcal, ['class' => 'form-control','placeholder' => '']) !!}
        
        <p>タンパク質を入力</p>
        {!! Form::text('protain', $meal->protain, ['class' => 'form-control','placeholder' => '']) !!}
        
        <p>炭水化物を入力</p>
        {!! Form::text('carbo', $meal->carbo, ['class' => 'form-control','placeholder' => '']) !!}
        
        <p>脂質を入力</p>
        {!! Form::text('fat', $meal->fat, ['class' => 'form-control','placeholder' => '']) !!}



        {!! Form::label('file_name','写真',['class' => 'filename__label']) !!}
        {!! Form::file('file_name',['class' => 'filename__form']) !!}
        
    
    {!! Form::submit('更新', ['class' => 'submitBtn','id']) !!}
    {!! Form::close() !!}




    {!! Form::open(['route' => ['meals.detroy','id' => $last],'method' => 'delete']) !!}
    @csrf
    {!! Form::submit('この商品を削除', ['class' => 'submitBtn denger','onclick' => 'delete_alert(event);return false;']) !!}
    {!! Form::close() !!}


</div>


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


    function delete_alert(e){
       if(!window.confirm('本当に削除しますか？')){
          return false;
       }
       document.deleteform.submit();
    };



  
    </script>



@endif

@endsection