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
                        <p style="margin-right:15px;"><span>{{ isset($data['protainAll']) ? $data['protainAll']['kcal']:0 }}</span>/kcal</p>
                        <p style="margin-right:15px;"><span>{{ isset($data['protainAll']) ? $data['protainAll']['protain']:0 }}</span>/P</p>
                        <p style="margin-right:15px;"><span>{{ isset($data['protainAll']) ? $data['protainAll']['carbo']:0 }}</span>/C</p>
                        <p><span>{{ isset($data['protainAll']) ? $data['protainAll']['fat']:0 }}</span>/F</p>
                        
                    </div>

                <div>

                

                @if(isset( $data['weight']->weight ))
                    <span>今日の体重：{{ $data['weight']->weight }}kg</span>
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