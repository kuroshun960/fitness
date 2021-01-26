@extends('layouts.app')
@section('content')

@if (Auth::check())



<a href="{{URL::to('/')}}">もどる</a>

{!! Form::open(['route' => 'protainsettings.setting']) !!}
@csrf

<p>プロテインのメーカー</p>
{!! Form::text('name', '', ['class' => 'form-control','placeholder' => 'メーカー名']) !!}
<br>

<p>１杯あたりのカロリーを入力</p>
{!! Form::text('kcal', '', ['class' => 'form-control','placeholder' => 'カロリー']) !!}
<br>

<p>１杯あたりの炭水化物を入力</p>
{!! Form::text('carbo', '', ['class' => 'form-control','placeholder' => '炭水化物']) !!}
<br>

<p>１杯あたりのタンパク質を入力</p>
{!! Form::text('protain', '', ['class' => 'form-control','placeholder' => 'タンパク質']) !!}
<br>


<br>
{!! Form::submit('設定', ['class' => 'btn btn-primary btn-block']) !!}
{!! Form::close() !!}



@endif

@endsection