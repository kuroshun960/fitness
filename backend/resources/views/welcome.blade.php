@extends('layouts.app')
@section('content')

@if (Auth::check())


    {{-- ユーザー名と今日の体重表示 --}}





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



@endif


@endsection