@extends('layouts.app')
@section('content')

@if (Auth::check())


{!! link_to_route('protainsettings.show','プロテイン設定',[],['class'=>'userRegistBtn']) !!}

    {{-- 今朝の体重を測定 --}}
    <div class="todayWeight">
        <div class="measurement__inner">
            <div class=""></div>

            {{-- 今朝の体重を測定”済み”であれば、体重測定フォームは表示しない --}}
            @if (!isset($weight))
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


    {{-- 今日のプロテインタスクチェック --}}

    <div class="todayProtain">
        <div class="todayProtain__inner" style="width: 400px;margin: 150px auto 0;">
            <p>今日のプロテインをチェック！</p>

            {!! Form::open(['route' => 'weight.input']) !!}
                @csrf
 
                {!! Form::submit('飲んだ!', ['name' => 'firstcup','class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}





        </div>
    </div>




@endif

@endsection