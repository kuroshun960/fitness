@extends('layouts.app')
@section('content')

@if (Auth::check())


@php
$todaydate = date("Y-m-d");
// dd( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->skip(2)->first()->cups ); //
@endphp


{!! link_to_route('protainsettings.show','プロテイン設定',[],['class'=>'userRegistBtn']) !!}

    

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




@if( count( Auth::user()->protainsetting()->get() ) >= 1 )


    {{-- 今日のプロテインタスクチェック --}}

    <div class="todayProtain">
        <div class="todayProtain__inner" style="width: 400px;margin: 150px auto 0;">

            @if( count( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->get() ) <= 2 )
            <p>今日のプロテインをチェック！</p>
            @endif

        </div>

        <div class="todayProtain__tasks" style="width:500px;margin:0 auto;">
            <div class="todayProtain__tasks__inner" style="display: flex;justify-content: space-between;">
                

                @if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->first() === null)
                <div class="todayProtaintask a">
                    {!! Form::open(['route' => 'protaintasks.drank']) !!}
                        @csrf
        
                        {!! Form::submit('飲んだ!', ['name' => 'firstcup','class' => 'btn btn-primary btn-block']) !!}
                    {!! Form::close() !!}
                </div>
                @endif
                

                @if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->skip(1)->first() === null)
                <div class="todayProtaintask b">
                    {!! Form::open(['route' => 'protaintasks.drank']) !!}
                        @csrf
        
                        {!! Form::submit('飲んだ!', ['name' => 'secondcup','class' => 'btn btn-primary btn-block']) !!}
                    {!! Form::close() !!}
                </div>
                @endif

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


@endif

@endsection