@extends('layouts.app')
@section('content')


            {!! Form::open(['route' => 'date.input']) !!}

                @csrf
                
                <p>今日の日付は？</p>
                
                {!! Form::text('number', old(''), ['class' => 'form-control','placeholder' => '今日の日付 1000-01-01']) !!}
                <br>

                <br>
                {!! Form::submit('日付を設定', ['class' => 'btn btn-primary btn-block']) !!}
        
            {!! Form::close() !!}


    <div class="todayWeight">
        <div class="measurement__inner">

            <div class=""></div>


            

            {!! Form::open(['route' => 'weight.input']) !!}

                @csrf
                
                <p>今朝の体重は測りましたか？</p>
                
                {!! Form::text('number', old(''), ['class' => 'form-control','placeholder' => '体重を入力']) !!}
                <br>
        
                <p>kg</p>
        
                <br>
                {!! Form::submit('測った', ['class' => 'btn btn-primary btn-block']) !!}
        
            {!! Form::close() !!}


        </div>
    </div>





@endsection