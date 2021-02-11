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
                    <div class="navIncrease"><p class="navIncrease_item">{{ Auth::user()->IncreaseOrDecrease }}</p><p class="navIncrease_item__number">{{ $data['continueDay'] }}</p><p class="navIncrease_item">日継続中</p></div>
                    
                    <div class="navMeasurement">

                        <p style="margin-right:15px;"><span class="navNutrition">{{ isset($data['sumKcal1']) ? number_format($data['sumKcal1']['kcal']):0 }}</span><span class="navNutrition_goal">/</span><span>{{ number_format(Auth::user()->kcalParday) }}kcal</span></p>

                        <p style="margin-right:15px;"><span class="navNutrition">{{ isset($data['sumKcal1']) ? $data['sumKcal1']['protain']:0 }}</span><span class="navNutrition_goal">/</span><span>{{ isset($data['parprotain']) ? $data['parprotain'] : 0 }}P</span></p>
                        
                        <p style="margin-right:15px;"><span class="navNutrition">{{ isset($data['sumKcal1']) ? $data['sumKcal1']['fat']:0 }}</span><span class="navNutrition_goal">/</span><span>{{ isset($data['parfat']) ? $data['parfat'] : 0 }}F</span></p>
                        <p><span class="navNutrition">{{ isset($data['sumKcal1']) ? $data['sumKcal1']['carbo']:0 }}</span><span class="navNutrition_goal">/</span><span>{{ isset($data['parcarbo']) ? $data['parcarbo'] : 0 }}C<span></p>
                        
                    </div>
                    

                    @if(isset( $data['weight']->weight ))

                        <div class="navIncrease"><p class="navIncrease_item">現在の体重</p><p class="navIncrease_item__number">{{ $data['weight']->weight }}</p><p class="navIncrease_item">kg</p></div>
                    @else
                        <div class="navIncrease"><p class="navIncrease_item">現在の体重</p><p class="navIncrease_item__number">--</p><p class="navIncrease_item">kg</p></div>
                    @endif

                    <div class="navIncrease userSetting"><p class="navIncrease_item">{{ Auth::user()->name }}</p><div class="userImage"><img src="" alt=""></div></div>
   

                @endif
            </div>
        </div>
    </nav>
</header>