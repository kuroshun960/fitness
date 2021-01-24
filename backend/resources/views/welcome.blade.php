@extends('layouts.app')
@section('content')





    <div class="todayWeight">
        <div class="measurement__inner">

            <div class=""></div>



            {!! Form::open(['route' => 'weight.post']) !!}

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