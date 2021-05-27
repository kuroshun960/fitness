<header class="">


        {{-- ナビゲーションバー --}}
        
            
        
        <nav class="">
            <div class="navibar">


                {!! link_to_route('users.show', 'MY-BODY', [], ['class' => 'logo']) !!}
            @if (Auth::check())
            <div class="navibar__inner">

                    <div class="navIncrease"><p class="navIncrease_item">{{ Auth::user()->IncreaseOrDecrease }}</p><p class="navIncrease_item__number continueDay">{{ $data['continueDay'] }}</p><p class="navIncrease_item continueDay">日継続中</p></div>
                    
                    <div class="navMeasurement">

                        <p class="navSumKcal" style="margin-right:15px;"><span class="navNutrition">{{ isset($data['sumKcal1']) ? number_format($data['sumKcal1']['kcal']):0 }}</span><span class="navNutrition_goal">/</span><span>{{ number_format(Auth::user()->kcalParday) }}kcal</span></p>

                        <p class="navSumProtain" style="margin-right:15px;"><span class="navNutrition">{{ isset($data['sumKcal1']) ? $data['sumKcal1']['protain']:0 }}</span><span class="navNutrition_goal">/</span><span>{{ isset($data['parprotain']) ? $data['parprotain'] : 0 }}P</span></p>
                        
                        <p class="navSumFat" style="margin-right:15px;"><span class="navNutrition">{{ isset($data['sumKcal1']) ? $data['sumKcal1']['fat']:0 }}</span><span class="navNutrition_goal">/</span><span>{{ isset($data['parfat']) ? $data['parfat'] : 0 }}F</span></p>
                        
                        <p class="navSumCarbo"><span class="navNutrition">{{ isset($data['sumKcal1']) ? $data['sumKcal1']['carbo']:0 }}</span><span class="navNutrition_goal">/</span><span>{{ isset($data['parcarbo']) ? $data['parcarbo'] : 0 }}C<span></p>
                        
                    </div>
                    

                    @if(isset( $data['weight']->weight ))

                        <div class="navIncrease navWeight"><p class="navIncrease_item">現在の体重</p><p class="navIncrease_item__number">{{ $data['weight']->weight }}</p><p class="navIncrease_item">kg</p></div>
                    @else
                        <div class="navIncrease navWeight"><p class="navIncrease_item">現在の体重</p><p class="navIncrease_item__number">--</p><p class="navIncrease_item">kg</p></div>
                    @endif

                    <div class="navIncrease userSetting">
                        <p class="navIncrease_item">{{ Auth::user()->name }}</p><div class="userImage"><img src="" alt=""></p>
                        <div class="userSetting__list">
                            <div>{!! link_to_route('protainsettingpage','プロテイン設定',[],['class'=>'userRegistBtn']) !!}</div>
                            <div>{!! link_to_route('personalsettingspage.show','パーソナル設定',[],['class'=>'userRegistBtn']) !!}</div>
                            <div>{!! link_to_route('mealssetting.show','食品リスト',[],['class'=>'userRegistBtn']) !!}</div>
                            <div>{!! link_to_route('logout.get', 'ログアウト', [], ['class' => '']) !!}</div>
                        </div>
                    </div>
   

                </div>


                
            @else
                
                    <div class="registAndlogin__btn">
                        {{-- ユーザ登録ページへのリンク --}}
                        {{--     {!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav_item nav__btn nav__register__btn']) !!} --}}

                        {{--ログインへのリンク --}}
                            {!! link_to_route('login', 'ログイン', [], ['class' => 'login__btn']) !!}

                    </div>

                
            @endif



        </div>
    </nav>
</header>