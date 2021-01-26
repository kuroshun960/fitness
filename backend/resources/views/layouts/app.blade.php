<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>MY-BODY</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

        <link rel="stylesheet" href="{{ asset('/css/style.css?3344144133433') }}">
        <link rel="stylesheet" href="{{ asset('/css/reset.css?3344144133433') }}">
        {{-- asset('ファイルパス')はpublicディレクトリのパスを返す関数。 --}}

    </head>

    <body>



        @if (Auth::check())
        <span>ユーザー名：</span>{{ Auth::user()->name }}<br>



        <span>今日の日付は：</span>
            @foreach ($dates as $date)
                {{ $date->date }}<br>
            @endforeach

        {{-- 
            <span>現在の体重：</span>
            @foreach ($todayweights as $todayweight)
            {{ $todayweight->weight }}<br>
            @endforeach
        --}}



        @endif



        {{-- ナビゲーションバー --}}


            
            @if (Auth::check())
            {{--ログアウトへのリンク --}}
            <div class="nav-item">{!! link_to_route('logout.get', 'Logout', [], ['class' => 'btn btn-lg btn-primary']) !!}</div>
            
            @else
            
            <div style="display: flex">
                <div class="">
                    {{-- ユーザ登録ページへのリンク --}}
                    {!! link_to_route('signup.get', 'ユーザー登録!', [], ['class' => 'btn btn-lg btn-primary']) !!}
                </div>
        
                    {{--ログインへのリンク --}}
                <div class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}</div>
            </div>
            
            @endif

        @include('commons.navbar')


            @yield('content')
        

        





        {{-- <script src="{{ asset('/jquery/jquery.js') }}"></script> --}}
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    
        


    </body>
</html>