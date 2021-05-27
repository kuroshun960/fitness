<?php $__env->startSection('content'); ?>

<?php if(Auth::check()): ?>

<a class="backBtn arrow arrow--right" href="<?php echo e(URL::to('/')); ?>"></a>

<div>
    <h2 style="text-align: center;font-size: 36px;"><?php echo e(date('n')); ?>月の日誌</h2>
    <div>
        <div class="dailyContainer">
            <div class="dailyContainer_box">

                
                <?php
                    $year = 2021;
                    $month = date('m');
                    $lastday = date('t',strtotime($year . "/" . $month . "/01"));
                    $i = 0;
                    $ss = (new DateTimeImmutable)->modify('first day of')->format('m-d'); 
                    $date = new DateTime('first day of this month');
                ?>

    
                <div class="daybox daybox__nonday"></div>
                <div class="daybox daybox__nonday"></div>
                <div class="daybox daybox__nonday"></div>
                <div class="daybox daybox__nonday"></div>
                <div class="daybox daybox__nonday"></div>






                                <?php for($c = 0; $c < $lastday; $c++): ?>
                                        <div>

                                                        <a href="<?php echo e(URL::to('daily/'.$date->modify($i.' day')->format('Y-m-d') )); ?>">

                                                            
                                                                        
                                                                        <?php if($date->format('m-d') === date('m-d')): ?>


                                                                                
                                                                                <div class="daybox daybox__today">
                                                                                
                                                                                    
                                                                                    <?php if(  isset($dayKcal[$date->format('y-m-d')])  ): ?>
                                                                                        <p><?php echo e($dayKcal[$date->format('y-m-d')]); ?><span class="daybox__kcal">kcal</span></p>
                                                                                    
                                                                                    <?php else: ?>
                                                                                        <p>0<span class="daybox__kcal">kcal</span></p>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            <p class="daybox__date" class="daily__today__box" style="text-align: center"><?php echo e($date->format('j')); ?></p>



                                                                        
                                                                        <?php else: ?>

                                                                                    
                                                                                    <?php if(  isset($dayKcal[$date->format('y-m-d')])  ): ?>
                                                                                        <div class="daybox loginday">
                                                                                            <span class="loginday"><?php echo e($dayKcal[$date->format('y-m-d')]); ?></span><span class="daybox__kcal">kcal</span>
                                                                                        </div>

                                                                                    
                                                                                    <?php else: ?>
                                                                                        <div class="daybox">
                                                                                            <p>0<span class="daybox__kcal">kcal</span></p>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                            <p class="daybox__date" style="text-align: center"><?php echo e($date->format('j')); ?></p>
                                                                        <?php endif; ?>
                                                        

                                                        </a>
                                            
                                                        <?php
                                                        $i = +1;
                                                        ?>
                                                        
                                        </div>
                                <?php endfor; ?>




                

                <div class="daybox daybox__nonday"></div>
                <div class="daybox daybox__nonday"></div>
                <div class="daybox daybox__nonday"></div>
                <div class="daybox daybox__nonday"></div>
                <div class="daybox daybox__nonday"></div>
                <div class="daybox daybox__nonday"></div>

            </div>
        </div>
    </div>
</div>



<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/daily.blade.php ENDPATH**/ ?>