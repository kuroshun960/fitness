<header class="">


        {{-- ナビゲーションバー --}}
            
        @if (Auth::check())

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
    
    <nav class="">
        <div class="navibar">
            <div class="navibar__inner">

                @if (Auth::check())
                <p><span>ユーザー名：</span>{{ Auth::user()->name }}</p>
                

                <p class="navIncrease">増量期<span></span>日継続中</p>

                    <div class="navMeasurement">
                        <p><span></span>/kcal</p>
                        <p><span></span>/P</p>
                        <p><span></span>/F</p>
                        <p><span></span>/C</p>
                    </div>

                <div>
                @if(isset($weight))
                    <span>今日の体重：{{ $weight->weight }}</span>
                @else
                    <span>今日の体重：未測定</span>
                @endif
                </div>

                {{--ログアウトへのリンク --}}
                <div class="nav-item">{!! link_to_route('logout.get', 'Logout', [], ['class' => 'btn btn-lg btn-primary']) !!}</div>
        

                @endif
            </div>
        </div>
    </nav>
</header>