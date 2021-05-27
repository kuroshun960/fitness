@extends('layouts.app')

@section('content')
<div class="login__container">

    <div class="text-center">
        <h2 class="login__title">新規登録</h2>
    </div>

    <div class="login__form__container">
        <div class="">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', '氏名', ['class' => 'form-title']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス', ['class' => 'form-title']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード', ['class' => 'form-title']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード(確認用)', ['class' => 'form-title']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('新規登録', ['class' => 'btn btn-primary login__btn']) !!}
            {!! Form::close() !!}
        </div>
    </div>

</div>
@endsection