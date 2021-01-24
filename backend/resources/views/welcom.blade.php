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

        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

            <div class="measurement">
                <div class="measurement__inner">
                    <div class="kcal">
                        <div class="kcal__day">
                            <p>摂取カロリー/日目標</p>
                            <p></p>
                            <p>今日の目標まであと <span></span>kcal</p>
                        </div>
                        <div class="kcal__week">

                        </div>
                    </div>
                </div>
            </div>



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





            @yield('content')
        

        





        {{-- <script src="{{ asset('/jquery/jquery.js') }}"></script> --}}
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    
        


    </body>
</html>