@extends('layouts.app')
@section('content')

@if (Auth::check())


@php
    $job_name_loop = [

    ];
@endphp

@if (count($errors) > 0)
        <ul class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <li class="ml-4">{{ $error }}</li>
            @endforeach
        </ul>
    @endif


<a class="backBtn arrow arrow--right" href="{{URL::to('/')}}"></a>


<div class="personal_setting__container">

    <h2 class="mealssetting__title">個人設定</h2>

    {!! Form::open(['route' => 'personalsettings.setting']) !!}
    @csrf

    <p>名前</p>
    {!! Form::text('name', Auth::user()->name, ['class' => 'form-control','placeholder' => '']) !!}

    <p>年齢</p>
    {!! Form::text('age', Auth::user()->age, ['class' => 'form-control','placeholder' => '']) !!}

    <p>身長</p>
    {!! Form::text('height', Auth::user()->height, ['class' => 'form-control','placeholder' => '']) !!}
    
    <p>性別</p>
    {{ Form::select('sex',['男性'=> '男性' ,'女性'=> '女性' ,], Auth::user()->sex, ['class' => 'my_class']) }}
    
    <p>目標は増量 / 減量（ダイエット）のどちらですか？</p>
    {{ Form::select('IncreaseOrDecrease',['増量期'=> '増量' ,'減量期'=> '減量' ,], null, ['class' => 'my_class']) }}

    <p>日常の運動量はどんなもんですか？</p>
    {{ Form::select('HardOrSoft',
    ['soft'=> '生活の大部分座ってる/事務' ,'middle'=> '立って移動や作業や運動する/接客・通勤・家事' ,'hard'=> '運動量の多い仕事/スポーツマン' ,],
    null, ['class' => 'my_class']) }}
    

    <p>日あたりの目標摂取カロリー</p>
    {!! Form::text('kcalParday', Auth::user()->kcalParday, ['class' => 'form-control','placeholder' => '']) !!}

    {!! Form::submit('設定', ['class' => 'submitBtn']) !!}
    {!! Form::close() !!}

</div>

@endif

@endsection