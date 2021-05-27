<header class="">


        
            
        <?php if(Auth::check()): ?>

        <?php else: ?>
        
        <div style="display: flex">
            <div class="">
                
                <?php echo link_to_route('signup.get', 'ユーザー登録!', [], ['class' => 'btn btn-lg btn-primary']); ?>

            </div>
    
                
            <div class="nav-item"><?php echo link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']); ?></div>
        </div>
        
        <?php endif; ?>
    
    <nav class="">
        <div class="navibar">
            <div class="navibar__inner">

                <?php if(Auth::check()): ?>
                <p><span>ユーザー名：</span><?php echo e(Auth::user()->name); ?></p>
                

                <p class="navIncrease">増量期<span></span>日継続中</p>

                    <div class="navMeasurement">
                        <p><span></span>/kcal</p>
                        <p><span></span>/P</p>
                        <p><span></span>/F</p>
                        <p><span></span>/C</p>
                    </div>

                <div>
                <?php if(isset($weight)): ?>
                    <span>今日の体重：<?php echo e($weight->weight); ?></span>
                <?php else: ?>
                    <span>今日の体重：未測定</span>
                <?php endif; ?>
                </div>

                
                <div class="nav-item"><?php echo link_to_route('logout.get', 'Logout', [], ['class' => 'btn btn-lg btn-primary']); ?></div>
        

                <?php endif; ?>
            </div>
        </div>
    </nav>
</header><?php /**PATH /work/resources/views/commons/notlogin.blade.php ENDPATH**/ ?>