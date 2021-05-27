<header class="">


        
        
            
        
        <nav class="">
            <div class="navibar">


                <?php echo link_to_route('users.show', 'MY-BODY', [], ['class' => 'logo']); ?>

            <?php if(Auth::check()): ?>
            <div class="navibar__inner">

                    <div class="navIncrease"><p class="navIncrease_item"><?php echo e(Auth::user()->IncreaseOrDecrease); ?></p><p class="navIncrease_item__number continueDay"><?php echo e($data['continueDay']); ?></p><p class="navIncrease_item continueDay">日継続中</p></div>
                    
                    <div class="navMeasurement">

                        <p class="navSumKcal" style="margin-right:15px;"><span class="navNutrition"><?php echo e(isset($data['sumKcal1']) ? number_format($data['sumKcal1']['kcal']):0); ?></span><span class="navNutrition_goal">/</span><span><?php echo e(number_format(Auth::user()->kcalParday)); ?>kcal</span></p>

                        <p class="navSumProtain" style="margin-right:15px;"><span class="navNutrition"><?php echo e(isset($data['sumKcal1']) ? $data['sumKcal1']['protain']:0); ?></span><span class="navNutrition_goal">/</span><span><?php echo e(isset($data['parprotain']) ? $data['parprotain'] : 0); ?>P</span></p>
                        
                        <p class="navSumFat" style="margin-right:15px;"><span class="navNutrition"><?php echo e(isset($data['sumKcal1']) ? $data['sumKcal1']['fat']:0); ?></span><span class="navNutrition_goal">/</span><span><?php echo e(isset($data['parfat']) ? $data['parfat'] : 0); ?>F</span></p>
                        
                        <p class="navSumCarbo"><span class="navNutrition"><?php echo e(isset($data['sumKcal1']) ? $data['sumKcal1']['carbo']:0); ?></span><span class="navNutrition_goal">/</span><span><?php echo e(isset($data['parcarbo']) ? $data['parcarbo'] : 0); ?>C<span></p>
                        
                    </div>
                    

                    <?php if(isset( $data['weight']->weight )): ?>

                        <div class="navIncrease navWeight"><p class="navIncrease_item">現在の体重</p><p class="navIncrease_item__number"><?php echo e($data['weight']->weight); ?></p><p class="navIncrease_item">kg</p></div>
                    <?php else: ?>
                        <div class="navIncrease navWeight"><p class="navIncrease_item">現在の体重</p><p class="navIncrease_item__number">--</p><p class="navIncrease_item">kg</p></div>
                    <?php endif; ?>

                    <div class="navIncrease userSetting">
                        <p class="navIncrease_item"><?php echo e(Auth::user()->name); ?></p><div class="userImage"><img src="" alt=""></p>
                        <div class="userSetting__list">
                            <div><?php echo link_to_route('protainsettingpage','プロテイン設定',[],['class'=>'userRegistBtn']); ?></div>
                            <div><?php echo link_to_route('personalsettingspage.show','パーソナル設定',[],['class'=>'userRegistBtn']); ?></div>
                            <div><?php echo link_to_route('mealssetting.show','食品リスト',[],['class'=>'userRegistBtn']); ?></div>
                            <div><?php echo link_to_route('logout.get', 'ログアウト', [], ['class' => '']); ?></div>
                        </div>
                    </div>
   

                </div>


                
            <?php else: ?>
                
                    <div class="registAndlogin__btn">
                        
                        

                        
                            <?php echo link_to_route('login', 'ログイン', [], ['class' => '']); ?>


                    </div>

                
            <?php endif; ?>



        </div>
    </nav>
</header><?php /**PATH /work/resources/views/commons/navbar.blade.php ENDPATH**/ ?>