<?php $__env->startSection('content'); ?>

<?php if(Auth::check()): ?>



<?php
$todaydate = date("Y-m-d");
$i = 0;
date("Y年m月d日", strtotime("1 day"))


?>



    <!---
    <div class="settingMenu">
        <div class="settingMenu__inner">
        <div><?php echo link_to_route('protainsettingpage','プロテイン設定',[],['class'=>'userRegistBtn']); ?></div>
        <div><?php echo link_to_route('personalsettingspage.show','パーソナル設定',[],['class'=>'userRegistBtn']); ?></div>
        <div><?php echo link_to_route('mealssetting.show','食品リスト',[],['class'=>'userRegistBtn']); ?></div>
        <div><?php echo link_to_route('logout.get', 'Logout', [], ['class' => '']); ?></div>
        </div>
    </div>
    -->



    <!---------------------------------------------------------------
        ユーザーの栄養情報セクション
    ----------------------------------------------------------------->


    <?php

        if( filter_var($data['kcalPardayToGoal']) ){
            $cdcdcd = 0;
        }else{
            $cdcdcd = $data['kcalPardayToGoal'];
        }

    ?>


    <div class="userStatus">
        <div class="status_background">

                <div class="userStatus__inner">

                    
                    <div class="userStatus__inner__nut">
                        <div class="userStatus__inner__kcal">
                            <div>
                                
                                <p>摂取カロリー/日目標</p>
                                <p><span><?php echo e(isset($data['sumKcal1']) ? number_format($data['sumKcal1']['kcal']):0); ?></span><span class="slash">/</span><span><?php echo e(number_format(Auth::user()->kcalParday)); ?>kcal</span></p>
                            </div>

                            <div>
                                <p>目標まで残り</p>
                                <p><span><?php echo e(number_format($cdcdcd)); ?></span><span>kcal</span></p>
                            </div>
                        </div>

                        <div class="userStatus__inner__pfc">
                            <div>
                                
                                <p>タンパク質</p>
                                <p class="P_num"><span class="P"><?php echo e(isset($data['sumKcal1']) ? $data['sumKcal1']['protain']:0); ?></span><span class="slash">/</span><span><?php echo e(isset($data['parprotain']) ? $data['parprotain'] : 0); ?>P</span></p>
                            </div>

                            <div>
                                <p>脂質</p>
                                <p class="F_num"><span class="F"><?php echo e(isset($data['sumKcal1']) ? $data['sumKcal1']['fat']:0); ?></span><span class="slash">/</span><span><?php echo e(isset($data['parfat']) ? $data['parfat'] : 0); ?>F</span></p>
                            </div>

                            <div>
                                <p>炭水化物</p>
                                <p class="C_num"><span class="C"><?php echo e(isset($data['sumKcal1']) ? $data['sumKcal1']['carbo']:0); ?></span><span class="slash">/</span><span><?php echo e(isset($data['parcarbo']) ? $data['parcarbo'] : 0); ?>C<span></p>
                            </div>
                        </div>
                    </div>

        
                            

                            
                            <div class="human">
                                <?php if(Auth::user()->sex === '男性'): ?><img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/men.png" alt="">
                                <?php else: ?><img src="https://kurofiles.s3-ap-northeast-1.amazonaws.com/meals/women.png" alt="" width="100%">
                                <?php endif; ?>
                            </div>

                            
                            <div class="userStatus__inner__metabo">
                                <div class="userStatus__weight">
                                    <?php if(isset( $data['weight']->weight)): ?>
                                    <div><p>現在の体重</p><p class="weight"><?php echo e($data['weight']->weight); ?><span>kg</span></p></div>
                                    <?php else: ?>
                                    <div><p>現在の体重</p><p class="weight">--<span>kg</span></p></div>
                                    <?php endif; ?>
                                    <p class="userStatus__weight__week">7日前より00kg</p>
                                </div>
                                <div class="userStatus__metabo">
                                    <div><p>適正体重</p><p><?php echo e($data['fitWeightFloor']); ?>kg</p></div>
                                    <div><p>基礎代謝</p><p><?php echo e($data['baseEnergy']); ?>kcal</p></div>
                                    <div><p>必要カロリー</p><p><?php echo e($data['needEnergy']); ?>kcal</p></div>
                                </div>
                            </div>




            
                </div>
            </div>
        </div>


    <!--
    <p>目標タンパク質まで:<?php echo e($data['protainPardayToGoal']); ?></p>
    <p>目標脂質まで:<?php echo e($data['fatPardayCeilToGoal']); ?></p>
    <p>目標炭水化物まで:<?php echo e($data['carboPardayCeilToGoal']); ?></p>
    -->
        
    <!--
    <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("today")) )); ?> "><p style="color: rgb(255, 55, 55)";>今日 : <?php echo e($data['sumKcal1']['kcal']); ?></p></a>
    <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-1 day")) )); ?> "><p><?php echo e(date('m/d', strtotime('-1 day'))); ?> : <?php echo e($data['sumKcal2']['kcal']); ?></p></a>
    <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-2 day")) )); ?> "><p><?php echo e(date('m/d', strtotime('-2 day'))); ?> : <?php echo e($data['sumKcal3']['kcal']); ?></p></a>
    <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-3 day")) )); ?> "><p><?php echo e(date('m/d', strtotime('-3 day'))); ?> :<?php echo e($data['sumKcal4']['kcal']); ?></p></a>
    <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-4 day")) )); ?> "><p><?php echo e(date('m/d', strtotime('-4 day'))); ?> :<?php echo e($data['sumKcal5']['kcal']); ?></p></a>
    <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-5 day")) )); ?> "><p><?php echo e(date('m/d', strtotime('-5 day'))); ?> :<?php echo e($data['sumKcal6']['kcal']); ?></p></a>
    <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-6 day")) )); ?> "><p><?php echo e(date('m/d', strtotime('-6 day'))); ?> :<?php echo e($data['sumKcal7']['kcal']); ?></p></a>
    -->






    <!---------------------------------------------------------------
        「体重を測定しよう」セクション
    ----------------------------------------------------------------->

    <?php if(!isset( $data['weight']->weight )): ?>
    
    <div class="todayWeight">
        <div class="todayWeight__inner">
            
            <?php echo Form::open(['route' => 'weight.input','class'=>'todayWeight__form']); ?> <?php echo csrf_field(); ?>
                
                <p>今朝の体重を記録しましょう。</p>
                <div class="todayWeightFrom"><?php echo Form::text('number', old(''), ['class' => 'todayWeight__form-control todayWeight_number form','placeholder' => '今日の体重を入力']); ?><div>kg</div></div>
                
                <div class="todayWeightSubmit"><?php echo Form::submit('記録', ['class' => 'todayWeight__form-control submit']); ?></div>

            <?php echo Form::close(); ?>

        </div>
    </div>
    <?php endif; ?>





    <!---------------------------------------------------------------
        「今日食べたものをチェック！」セクション
    ----------------------------------------------------------------->

    <div class="topMealsList">
        <div class="topMealsList__inner">

            <p>今日食べたものをチェック！</p>

            <?php echo Form::open(['route' => 'eats']); ?>


            <div class="topMealsList__group">
            <?php echo Form::radio('eatmeal', 1, false, ['id' => 1,'class' => 'topMealsList__Box__radio']); ?>

            <?php echo Form::label(1,'食事', ['class' => 'mealtype__meal__tab isActive' ]); ?>


            <?php echo Form::radio('eatmeal', 2, false, ['id' => 2,'class' => 'topMealsList__Box__radio']); ?>

            <?php echo Form::label(2,'おやつ', ['class' => 'mealtype__snack__tab']); ?>


            <?php echo Form::radio('eatmeal', 3, false, ['id' => 1,'class' => 'topMealsList__Box__radio']); ?>

            <?php echo Form::label(3,'飲み物', ['class' => 'mealtype__drink__tab']); ?>

            </div>
        <hr class="topMealsList__group__hr">
        

            <?php
                $userid = Auth::id();
                $isset_type_meal = DB::select(" SELECT * FROM meals WHERE type='食事' AND user_id=$userid ");
                $isset_type_snack = DB::select(" SELECT * FROM meals WHERE type='おやつ' AND user_id=$userid ");
                $isset_type_drink = DB::select(" SELECT * FROM meals WHERE type='飲料' AND user_id=$userid ");
            ?>


            <div class="topMealsList__container mealtype__meal">
                <?php if( count( $isset_type_meal ) === 0 ): ?>
                <div class="meals__noset"><p>登録した食品はこちらに登録されます。</p></div>
                <?php endif; ?>

                <?php $__currentLoopData = $data['mealslists']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mealslist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($mealslist->gram)): ?><?php $net = 'g' ?><?php elseif(isset($mealslist->piece)): ?><?php $net = '個' ?><?php endif; ?>
                    <?php if( $mealslist['type'] === '食事'): ?>

                        <?php echo Form::radio('eatmeal', $mealslist->id, false, ['id' => $mealslist->id,'class' => 'topMealsList__Box__radio']); ?>

                        
                        <?php if(isset($mealslist->item_photo_path)): ?><?php echo Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' itemImage' ,'style'=>'background-image: url("'.$mealslist->item_photo_path.'");']); ?>

                        
                        <?php else: ?><?php echo Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' noItemImage']); ?>

                        <?php endif; ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="topMealsList__container mealtype__snack">

                <?php if( count( $isset_type_snack ) === 0 ): ?>
                <div class="meals__noset"><p>登録した食品はこちらに登録されます。</p></div>
                <?php endif; ?>

                <?php $__currentLoopData = $data['mealslists']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mealslist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if(isset($mealslist->gram)): ?><?php $net = 'g' ?><?php elseif(isset($mealslist->piece)): ?><?php $net = '個' ?><?php endif; ?>
                    <?php if( $mealslist['type'] === 'おやつ'): ?>
                        <?php echo Form::radio('eatmeal', $mealslist->id, false, ['id' => $mealslist->id,'class' => 'topMealsList__Box__radio']); ?>

                        <?php if(isset($mealslist->item_photo_path)): ?><?php echo Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' itemImage' ,'style'=>'background-image: url("'.$mealslist->item_photo_path.'");']); ?>

                        <?php else: ?><?php echo Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' noItemImage']); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="topMealsList__container mealtype__drink">

                <?php if( count( $isset_type_drink ) === 0 ): ?>
                <div class="meals__noset"><p>登録した食品はこちらに登録されます。</p></div>
                <?php endif; ?>
                
                <?php $__currentLoopData = $data['mealslists']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mealslist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if(isset($mealslist->gram)): ?><?php $net = 'g' ?><?php elseif(isset($mealslist->piece)): ?><?php $net = '個' ?><?php endif; ?>
                    <?php if( $mealslist['type'] === '飲料'): ?>
                        <?php echo Form::radio('eatmeal', $mealslist->id, false, ['id' => $mealslist->id,'class' => 'topMealsList__Box__radio']); ?>

                        <?php if(isset($mealslist->item_photo_path)): ?><?php echo Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' itemImage' ,'style'=>'background-image: url("'.$mealslist->item_photo_path.'");']); ?>

                        <?php else: ?><?php echo Form::label($mealslist->id, $mealslist->name, ['class' => 'topMealsList__Box '.$net.' noItemImage']); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>




            <div class="topMealsList__input">
                <p><span class="mealname"></span></p>
                <div class="topMealsList__net">
                    <div><?php echo Form::text('net', '', ['class' => 'eatnet','placeholder' => '摂取量']); ?></div>
                    <p><span class="mealnettype"></span></p>
                    <div><?php echo Form::submit('食べた！', ['class' => 'btn  eatBtn']); ?></div>
                </div>
            </div>

            <?php echo Form::close(); ?>

            <br>

            

        </div>
    </div>






    <!---------------------------------------------------------------
        プロテインタスク セクション
    ----------------------------------------------------------------->

    
    <div class="todayProtain">
    <?php if( count( Auth::user()->protainsetting()->get() ) >= 1 ): ?>

        
        <?php if( count( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->get() ) <= 2 ): ?>
        <p>今日のプロテインをチェック！</p>
        <?php else: ?><p>今日のプロテインは全て飲み終えました</p>
        <?php endif; ?>
        

            <div class="todayProtain__tasks">
                <div class="todayProtain__tasks__inner">
                    
                    
                    <div class="a">
                        <?php echo Form::open(['route' => 'protaintasks.drank']); ?>

                        <?php echo csrf_field(); ?>
                        
                        <?php if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->first() === null): ?>
                            <?php echo Form::submit('飲んだ!', ['name' => 'firstcup','class' => 'todayProtaintask']); ?>

                        <?php else: ?> <div class="todayProtaintask__done"></div>
                        <?php endif; ?>
                            
                        <?php echo Form::close(); ?>

                    </div>


                    
                    
                    <div class="b">
                        <?php echo Form::open(['route' => 'protaintasks.drank']); ?>

                        <?php echo csrf_field(); ?>

                        <?php if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->first() === null): ?>
                                <div class="todayProtaintask__missorder">飲んだ</div>
                        <?php else: ?>
                            <?php if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->skip(1)->first() === null): ?>
                                <?php echo Form::submit('飲んだ!', ['name' => 'secondcup','class' => 'todayProtaintask']); ?>

                            <?php else: ?> <div class="todayProtaintask__done"></div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php echo Form::close(); ?>

                    </div>
                    

                    
                    <div class="c">
                        <?php echo Form::open(['route' => 'protaintasks.drank']); ?>

                        <?php echo csrf_field(); ?>
                        

                        <?php if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->skip(1)->first() === null): ?>
                                <div class="todayProtaintask__missorder">飲んだ</div>
                        <?php else: ?>
                            <?php if( Auth::user()->protaintasks()->whereDate('created_at', $todaydate)->skip(2)->first() === null): ?>
                                <?php echo Form::submit('飲んだ!', ['name' => 'secondcup','class' => 'todayProtaintask']); ?>

                            <?php else: ?> <div class="todayProtaintask__done"></div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php echo Form::close(); ?>

                    </div>
                    

                </div>
            </div>

    <?php else: ?>

    <div class="protainsetteing__noset">
        <p>プロテインをお飲みの方は、<br class="phone__br"><?php echo link_to_route('protainsettingpage','プロテイン設定',[],['class'=>'userRegistBtn']); ?>をしましょう。</p>
    </div>
    
    <?php endif; ?>






    <!---------------------------------------------------------------
        デイリーグラフ＆日誌 セクション
    ----------------------------------------------------------------->

    <div class="daily">
        <div class="dayContainer">
            <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-6 day")) )); ?> ">
                <div class="dayBox _6"><?php echo e($data['sumKcal7']['kcal']); ?><span>kcal</span></div>
                    
                    <?php $sumKcal7parGoal = $data['sumKcal7']['kcal']/ Auth::user()->kcalParday *100;?>
                <div class="date"><?php echo e(date('m/d', strtotime('-6 day'))); ?></div>
            </a>
        </div>
        <div class="dayContainer">
            <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-5 day")) )); ?> ">
                <div class="dayBox _5"><?php echo e($data['sumKcal6']['kcal']); ?><span>kcal</span></div>
                    
                    <?php $sumKcal6parGoal = $data['sumKcal6']['kcal']/Auth::user()->kcalParday*100;?>
                <div class="date"><?php echo e(date('m/d', strtotime('-5 day'))); ?></div>
            </a>
        </div>
        <div class="dayContainer">
            <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-4 day")) )); ?> ">
                <div class="dayBox _4"><?php echo e($data['sumKcal5']['kcal']); ?><span>kcal</span></div>
                    
                    <?php $sumKcal5parGoal = $data['sumKcal5']['kcal']/Auth::user()->kcalParday*100;?>
                <div class="date"><?php echo e(date('m/d', strtotime('-4 day'))); ?></div>
            </a>
        </div>
        <div class="dayContainer">
            <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-3 day")) )); ?> ">
                <div class="dayBox _3"><?php echo e($data['sumKcal4']['kcal']); ?><span>kcal</span></div>
                    
                    <?php $sumKcal4parGoal = $data['sumKcal4']['kcal']/Auth::user()->kcalParday*100;?>
                <div class="date"><?php echo e(date('m/d', strtotime('-3 day'))); ?></div>
            </a>
        </div>
        <div class="dayContainer">
            <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-2 day")) )); ?> ">
                <div class="dayBox _2"><?php echo e($data['sumKcal3']['kcal']); ?><span>kcal</span></div>
                        
                    <?php $sumKcal3parGoal = $data['sumKcal3']['kcal']/Auth::user()->kcalParday*100;?>
                <div class="date"><?php echo e(date('m/d', strtotime('-2 day'))); ?></div>
        </div>

        <div class="dayContainer">
            <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("-1 day")) )); ?> ">
                <div class="dayBox _1"><?php echo e($data['sumKcal2']['kcal']); ?><span>kcal</span></div>
                        
                    <?php $sumKcal2parGoal = $data['sumKcal2']['kcal']/Auth::user()->kcalParday*100;?>
                <div class="date"><?php echo e(date('m/d', strtotime('-1 day'))); ?></div>
            </a>
        </div>

        <div class="dayContainer__today">
            <a href="<?php echo e(URL::to('daily/'.date("Y-m-d", strtotime("today")) )); ?> ">
                <div class="dayBox__today"><?php echo e($data['sumKcal1']['kcal']); ?><span>kcal</span></div>
                    
                    <?php $sumKcal1parGoal = $data['sumKcal1']['kcal']/Auth::user()->kcalParday*100;?>
                <div class="date__today">今日</div>
            </a>
        </div>
    </div>


    <?php echo link_to_route('users.daily','日誌',[],['class'=>'dailyBtn']); ?>


    </div>






    <!---------------------------------------------------------------
        食品登録セクション
    ----------------------------------------------------------------->

    <!----バリデーション---->
    <?php if(count($errors) > 0): ?>
        <ul class="alert alert-danger" role="alert">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="ml-4"><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>


    <div class="mealFrom">
        <div class="mealFrom__inner">

        <p>食品を登録する</p>

        <?php echo Form::open(['route' => 'mealssetting.setting','enctype'=>'multipart/form-data']); ?>

        <?php echo csrf_field(); ?>
        
        <div>
        <p>種別</p>
        <?php echo e(Form::select('type',['食事'=> '食事' ,'飲料'=> '飲料' ,'おやつ'=> 'おやつ'], null, ['class' => 'meal-form'])); ?>

        </div>

        <div>
        <p>食名</p>
        <?php echo Form::text('name', '', ['class' => 'meal-form','placeholder' => '']); ?>

        </div>

        <div>
        <p>種別</p>
        <?php echo e(Form::select('',['gram'=> 'グラム' ,'piece'=> '個数'], 'gram', ['class' => 'meal-form type'])); ?>

        </div>

        <div class="gram">
        <p class="">内容量</p>
        <?php echo Form::text('gram', '', ['class' => 'meal-form gram','placeholder' => '','selected']); ?>

        <p class="">g</p>
        </div>
        
        <div class="piece">
        <p class="">内容量</p>
        <?php echo Form::text('piece', '', ['class' => 'meal-form piece','placeholder' => '']); ?>

        <p class="">個</p>
        </div>

        <div>
        <p>価格</p>
        <?php echo Form::text('price', '', ['class' => 'meal-form','placeholder' => '']); ?>

        <p>円</p>
        </div>

        <div>
        <p>カロリー</p>
        <?php echo Form::text('kcal', '', ['class' => 'meal-form','placeholder' => '']); ?>

        <p>kcal</p>
        </div>

        <div>
        <p>タンパク質</p>
        <?php echo Form::text('protain', '', ['class' => 'meal-form','placeholder' => '']); ?>

        </div>

        <div>
        <p>炭水化物</p>
        <?php echo Form::text('carbo', '', ['class' => 'meal-form','placeholder' => '']); ?>

        </div>

        <div>
        <p>脂質</p>
        <?php echo Form::text('fat', '', ['class' => 'meal-form','placeholder' => '']); ?>

        </div>

        <div>
        <p>写真</p>
        <?php echo Form::file('file_name', ['class' => 'filename__form','style' => 'margin-top: 0px']); ?>

        </div>
        
        <div class=""><?php echo Form::submit('登録する', ['class' => 'mealregist']); ?></div>
        <?php echo Form::close(); ?>


        </div>
    </div>






    <!---------------------------------------------------------------
        動的表現のスクリプト類
    ----------------------------------------------------------------->

    <!----”個数”の単位はデフォルトで非表示---->
    <style>
        .piece{display: none;}
    </style>


    <script>


    $(function(){

    $('.userSetting').click(function(){     
    $('.settingMenu').slideToggle(200);
    });

    //グラム、個数のフォームをセレクトで分岐
    $(".type").change(function() {
        var type_val = $(".type").val();
            if(type_val == "gram") {
                $('.gram').css('display', 'flex');
                $('.piece').css('display', 'none').val(null).val();
            }if(type_val == "piece") {
                $('.gram').css('display', 'none').val(null).val();
                $('.piece').css('display', 'flex');
        }
    });

    //商品をクリックすると摂取量入力画面を表示
    $('.topMealsList__Box').click(function(){  

        var val = $(this).attr('id');
        var mealname = $(this).text();
        var mealnettype = $(this).attr('class');
        var mealnettypes = mealnettype.split(' ');
        
        
        $('.topMealsList__input').show('display', 'flex');
        $(this).addClass('checked');
        $('.checked').not(this).removeClass('checked');

        $('.eatnet').css('display','block');
        $('.eatBtn').css('display','block');
        $('.mealname').html(mealname);
        $('.mealnettype').html(mealnettypes[1]);
    });

    //商品タイプ 食事
    $('.mealtype__meal__tab').click(function(){  
        setTimeout(function(){ $('.mealtype__meal').fadeIn(300).css('display','flex'); },300);
        $('.mealtype__snack').fadeOut(300);
        $('.mealtype__drink').fadeOut(300);

        $(this).addClass('isActive');
        $('.isActive').not(this).removeClass('isActive');
    });

    //商品タイプ おやつ
    $('.mealtype__snack__tab').click(function(){  
        setTimeout(function(){ $('.mealtype__snack').fadeIn(300).css('display','flex'); },300);
        $('.mealtype__meal').fadeOut(300);
        $('.mealtype__drink').fadeOut(300);
        $(this).addClass('isActive');
        $('.isActive').not(this).removeClass('isActive');

    });

    //商品タイプ 飲み物
    $('.mealtype__drink__tab').click(function(){  
        setTimeout(function(){ $('.mealtype__drink').fadeIn(300).css('display','flex'); },300);
        $('.mealtype__snack').fadeOut(300);
        $('.mealtype__meal').fadeOut(300);
        $(this).addClass('isActive');
        $('.isActive').not(this).removeClass('isActive');
    });






  /*----------------------------------------------------------------------------------------------
        日誌/日別摂取カロリーグラフ  摂取カロリーの合計が、目標カロリーに対して、何割なのかでCSSを分岐する処理
  ----------------------------------------------------------------------------------------------*/

        
    var sumKcal1parGoal = <?php echo$sumKcal1parGoal; ?> ;
    var sumKcal2parGoal = <?php echo$sumKcal2parGoal; ?> ;
    var sumKcal3parGoal = <?php echo$sumKcal3parGoal; ?> ;
    var sumKcal4parGoal = <?php echo$sumKcal4parGoal; ?> ;
    var sumKcal5parGoal = <?php echo$sumKcal5parGoal; ?> ;
    var sumKcal6parGoal = <?php echo$sumKcal6parGoal; ?> ;
    var sumKcal7parGoal = <?php echo$sumKcal7parGoal; ?> ;

    switch(true){
        case sumKcal1parGoal >= 90:
        $(".dayBox__today").css('height','300px')
        break;
        case sumKcal1parGoal >= 80:
        $(".dayBox__today").css('height','270px')
        break;
        case sumKcal1parGoal >= 70:
        $(".dayBox__today").css('height','240px')
        break;
        case sumKcal1parGoal >= 60:
        $(".dayBox__today").css('height','210px')
        break;
        case sumKcal1parGoal >= 50:
        $(".dayBox__today").css('height','180px')
        break;
        case sumKcal1parGoal >= 40:
        $(".dayBox__today").css('height','150px')
        break;
        case sumKcal1parGoal >= 30:
        $(".dayBox__today").css('height','120px')
        break;
        case sumKcal1parGoal >= 20:
        $(".dayBox__today").css('height','90px')
        break;
        case sumKcal1parGoal >= 10:
        $(".dayBox__today").css('height','60px')
        break;
        case sumKcal1parGoal >= 0:
        $(".dayBox__today").css('height','30px')
        $(".dayBox__today").css('padding','8px 5px 0')
        break;
    }

    switch(true){
        case sumKcal2parGoal >= 90:
        $("._1").css('height','300px')
        break;
        case sumKcal2parGoal >= 80:
        $("._1").css('height','270px')
        break;
        case sumKcal2parGoal >= 70:
        $("._1").css('height','240px')
        break;
        case sumKcal2parGoal >= 60:
        $("._1").css('height','210px')
        break;
        case sumKcal2parGoal >= 50:
        $("._1").css('height','180px')
        break;
        case sumKcal2parGoal >= 40:
        $("._1").css('height','150px')
        break;
        case sumKcal2parGoal >= 30:
        $("._1").css('height','120px')
        break;
        case sumKcal2parGoal >= 20:
        $("._1").css('height','90px')
        break;
        case sumKcal2parGoal >= 10:
        $("._1").css('height','60px')
        break;
        case sumKcal2parGoal >= 0:
        $("._1").css('height','30px')
        $("._1").css('padding','8px 0 0')
        break;
    }

    switch(true){
        case sumKcal3parGoal >= 90:
        $("._2").css('height','300px')
        break;
        case sumKcal3parGoal >= 80:
        $("._2").css('height','270px')
        break;
        case sumKcal3parGoal >= 70:
        $("._2").css('height','240px')
        break;
        case sumKcal3parGoal >= 60:
        $("._2").css('height','210px')
        break;
        case sumKcal3parGoal >= 50:
        $("._2").css('height','180px')
        break;
        case sumKcal3parGoal >= 40:
        $("._2").css('height','150px')
        break;
        case sumKcal3parGoal >= 30:
        $("._2").css('height','120px')
        break;
        case sumKcal3parGoal >= 20:
        $("._2").css('height','90px')
        break;
        case sumKcal3parGoal >= 10:
        $("._2").css('height','60px')
        break;
        case sumKcal3parGoal >= 0:
        $("._2").css('height','30px')
        $("._2").css('padding','8px 0 0')
        break;
    }

    switch(true){
        case sumKcal4parGoal >= 90:
        $("._3").css('height','300px')
        break;
        case sumKcal4parGoal >= 80:
        $("._3").css('height','270px')
        break;
        case sumKcal4parGoal >= 70:
        $("._3").css('height','240px')
        break;
        case sumKcal4parGoal >= 60:
        $("._3").css('height','210px')
        break;
        case sumKcal4parGoal >= 50:
        $("._3").css('height','180px')
        break;
        case sumKcal4parGoal >= 40:
        $("._3").css('height','150px')
        break;
        case sumKcal4parGoal >= 30:
        $("._3").css('height','120px')
        break;
        case sumKcal4parGoal >= 20:
        $("._3").css('height','90px')
        break;
        case sumKcal4parGoal >= 10:
        $("._3").css('height','60px')
        break;
        case sumKcal4parGoal >= 0:
        $("._3").css('height','30px')
        $("._3").css('padding','8px 0 ')
        break;
    }

    switch(true){
        case sumKcal5parGoal >= 90:
        $("._4").css('height','300px')
        break;
        case sumKcal5parGoal >= 80:
        $("._4").css('height','270px')
        break;
        case sumKcal5parGoal >= 70:
        $("._4").css('height','240px')
        break;
        case sumKcal5parGoal >= 60:
        $("._4").css('height','210px')
        break;
        case sumKcal5parGoal >= 50:
        $("._4").css('height','180px')
        break;
        case sumKcal5parGoal >= 40:
        $("._4").css('height','150px')
        break;
        case sumKcal5parGoal >= 30:
        $("._4").css('height','120px')
        break;
        case sumKcal5parGoal >= 20:
        $("._4").css('height','90px')
        break;
        case sumKcal5parGoal >= 10:
        $("._4").css('height','60px')
        break;
        case sumKcal5parGoal >= 0:
        $("._4").css('height','30px')
        $("._4").css('padding','8px 0 0')
        break;
    }

    switch(true){
        case sumKcal6parGoal >= 90:
        $("._5").css('height','300px')
        break;
        case sumKcal6parGoal >= 80:
        $("._5").css('height','270px')
        break;
        case sumKcal6parGoal >= 70:
        $("._5").css('height','240px')
        break;
        case sumKcal6parGoal >= 60:
        $("._5").css('height','210px')
        break;
        case sumKcal6parGoal >= 50:
        $("._5").css('height','180px')
        break;
        case sumKcal6parGoal >= 40:
        $("._5").css('height','150px')
        break;
        case sumKcal6parGoal >= 30:
        $("._5").css('height','120px')
        break;
        case sumKcal6parGoal >= 20:
        $("._5").css('height','90px')
        break;
        case sumKcal6parGoal >= 10:
        $("._5").css('height','60px')
        break;
        case sumKcal6parGoal >= 0:
        $("._5").css('height','30px')
        $("._5").css('padding','8px 0 0')
        break;
    }

    switch(true){
        case sumKcal7parGoal >= 90:
        $("._6").css('height','300px')
        break;
        case sumKcal7parGoal >= 80:
        $("._6").css('height','270px')
        break;
        case sumKcal7parGoal >= 70:
        $("._6").css('height','240px')
        break;
        case sumKcal7parGoal >= 60:
        $("._6").css('height','210px')
        break;
        case sumKcal7parGoal >= 50:
        $("._6").css('height','180px')
        break;
        case sumKcal7parGoal >= 40:
        $("._6").css('height','150px')
        break;
        case sumKcal7parGoal >= 30:
        $("._6").css('height','120px')
        break;
        case sumKcal7parGoal >= 20:
        $("._6").css('height','90px')
        break;
        case sumKcal7parGoal >= 10:
        $("._6").css('height','60px')
        break;
        case sumKcal7parGoal >= 0:
        $("._6").css('height','30px')
        $("._6").css('padding','8px 0 0')
        break;
    }







    });
    </script>



<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/welcome.blade.php ENDPATH**/ ?>