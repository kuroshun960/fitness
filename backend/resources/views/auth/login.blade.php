@extends('layouts.app')

@section('content')
<div class="login__container">

    <div class="text-center">
        <h2 class="login__title">ログイン</h2>
    </div>

    <div class="row login__form__container">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス', ['class' => 'form-title']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード', ['class' => 'form-title']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('ログイン', ['class' => 'login__btn']) !!}
            {!! Form::close() !!}

            {{-- ユーザ登録ページへのリンク --}}
            <p class="mt-2 mini__link">アカウントをお持ちでない方は<span class="">{!! link_to_route('signup.get', 'こちら') !!}</span></p>
        </div>
    </div>

</div>
@endsection