@extends('layouts.app')

@section('content')




<div class="serviceTop">
    <div class="mybody_logo">
        <div class="mybody_logo__inner"><img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/mybody_logo.png" alt="" width="100%"></div>
        <div class="mybody_logo__text">MY-BODY</div>
    </div>
    <div class="serviceTop__innner">
        <img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/mybody_servicetop.jpg" alt="" width="100%">
    </div>
</div>

@if (count($errors) > 0)
<ul class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
        <li class="ml-4">{{ $error }}</li>
    @endforeach
</ul>
@endif

<div class="login__container">

    <div class="text-center">
        <h2 class="login__title">ログイン</h2>
    </div>

    <div class="login__form__container">
        <div class="">

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




<div class="serviceDescription">
    <div class="serviceDescription__inner">

    </div>
</div>



@endsection