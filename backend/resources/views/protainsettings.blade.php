@extends('layouts.app')
@section('content')

@if (Auth::check())


<a class="backBtn arrow arrow--right" href="{{URL::to('/')}}"></a>


<div class="protain_setting__container">

    <h2 class="mealssetting__title">プロテインの栄養価情報を登録します</h2>

    {!! Form::open(['route' => 'protainsettings.setting']) !!}
    @csrf

    <p>プロテインのメーカー</p>
    {!! Form::text('name', $regist_protain->name, ['class' => 'form-control','placeholder' => 'メーカー名']) !!}
    

    <p>１杯あたりのカロリーを入力</p>
    {!! Form::text('kcal', $regist_protain->kcal, ['class' => 'form-control','placeholder' => 'カロリー']) !!}
    

    <p>１杯あたりのタンパク質を入力</p>
    {!! Form::text('protain', $regist_protain->protain, ['class' => 'form-control','placeholder' => 'タンパク質']) !!}
    

    <p>１杯あたりの炭水化物を入力</p>
    {!! Form::text('carbo', $regist_protain->carbo, ['class' => 'form-control','placeholder' => '炭水化物']) !!}
    

    <p>１杯あたりの脂質を入力</p>
    {!! Form::text('fat', $regist_protain->fat, ['class' => 'form-control','placeholder' => '脂質']) !!}
    

    {!! Form::submit('設定', ['class' => 'submitBtn']) !!}
    {!! Form::close() !!}

</div>


@endif

@endsection