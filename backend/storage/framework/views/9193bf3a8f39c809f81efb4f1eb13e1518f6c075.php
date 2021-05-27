<?php $__env->startSection('content'); ?>

<?php if(Auth::check()): ?>


<a class="backBtn arrow arrow--right" href="<?php echo e(URL::to('/daily')); ?>"></a>


<style>

    .item{
        margin-bottom: 10px;
    }

</style>


<div class="daypage__hidden">



    <h2 class="mealssetting__title"><?php echo e($day); ?>の食事内容</h2>


    <div class="daypage__scroll">

        <div class="daypage_meallist">


                    <div class="daypage_meallist__rows__title daypage_meallist__rows" style='display: flex;'>
                    <p>商品名</p>
                    <p>カロリー</p>
                    <p>タンパク質</p>
                    <p>脂質</p>
                    <p>炭水化物</p>
                    <p>費用</p>
                    <p>摂取量</p>
                    </div>


                <?php $__currentLoopData = $eatmeals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eatmeal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="daypage_meallist__rows__container">

                        <div class="daypage_meallist__rows" style='display: flex;'>
                        <p><?php echo e($eatmeal->name); ?></p>
                        <p><?php echo e($eatmeal->eatKcal); ?><span class="phone__display__none">kcal</span></p>
                        <p><?php echo e($eatmeal->eatProtain); ?><span class="phone__display__none">p</span></p>
                        <p><?php echo e($eatmeal->eatFat); ?><span class="phone__display__none">f</span></p>
                        <p><?php echo e($eatmeal->eatCarbo); ?><span class="phone__display__none">c</span></p>
                        <p><?php echo e($eatmeal->eatPrice); ?>円</p>
                        <p><?php echo e($eatmeal->eatNet); ?></p>
                        </div>

                        <div>
                        <?php echo Form::open(['route' => ['eats.destroy']]); ?>

                            <?php echo Form::submit('削除', [ 'name' => $eatmeal->id,'value' => $eatmeal->id,'class' => 'btn btn-danger btn-sm eatsdestroy_btn']); ?>

                        <?php echo Form::close(); ?>

                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php $__currentLoopData = $protaintasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $protaintask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="daypage_protain__rows daypage_meallist__rows" style='display: flex;'>

                            <p>プロテイン</p>
                            <p><?php echo e($protaintask->kcal); ?><span class="phone__display__none">kcal</span></p>
                            <p><?php echo e($protaintask->protain); ?><span class="phone__display__none">p</span></p>
                            <p><?php echo e($protaintask->fat); ?><span class="phone__display__none">f</span></p>
                            <p><?php echo e($protaintask->carbo); ?><span class="phone__display__none">c</span></p>
                            <p>-</p>
                            <p>-</p>

                </div>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>

    <div class="daypage_nutritiondate">
        <div><p>総カロリー</p><p><?php echo e($nutdata['allKcal']); ?> kcal</p></div>
        <div><p>総タンパク質</p><p><?php echo e($nutdata['allProtain']); ?> P</p></div>
        <div><p>総脂質</p><p><?php echo e($nutdata['allFat']); ?> F</p></div>
        <div><p>総炭水化物</p><p><?php echo e($nutdata['allCarbo']); ?> C</p></div>
        <div><p>総費用</p><p><?php echo e($nutdata['allPrice']); ?> 円</p></div>
    </div>





</div>



<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/daypage.blade.php ENDPATH**/ ?>