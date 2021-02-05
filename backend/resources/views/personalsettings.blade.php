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


<a href="{{URL::to('/')}}">もどる</a>

{!! Form::open(['route' => 'personalsettings.setting']) !!}
@csrf

<p>名前</p>
{!! Form::text('name', '', ['class' => 'form-control','placeholder' => '']) !!}
<br>

<p>年齢</p>
{!! Form::text('age', '', ['class' => 'form-control','placeholder' => '']) !!}
<br>

<p>身長</p>
{!! Form::text('height', '', ['class' => 'form-control','placeholder' => '']) !!}
<br>

<p>今は増量期/減量期どちらですか？</p>
{{ Form::select('IncreaseOrDecrease',['増量期'=> '増量期' ,'減量期'=> '減量期' ,], null, ['class' => 'my_class']) }}
<br>

<p>日常の運動量はどんなもんですか？</p>
{{ Form::select('HardOrSoft',
['soft'=> '生活の大部分座ってる/事務' ,'middle'=> '立って移動や作業や運動する/接客・通勤・家事' ,'hard'=> '運動量の多い仕事/スポーツマン' ,],
 null, ['class' => 'my_class']) }}
<br>

<p>性別はどちらですか？</p>
{{ Form::select('sex',['男性'=> '男性' ,'女性'=> '女性' ,], null, ['class' => 'my_class']) }}
<br>

<p>日あたりの目標摂取カロリー</p>
{!! Form::text('kcalParday', '', ['class' => 'form-control','placeholder' => '']) !!}
<br>

<br>
{!! Form::submit('設定', ['class' => 'btn btn-primary btn-block']) !!}
{!! Form::close() !!}



@endif

@endsection