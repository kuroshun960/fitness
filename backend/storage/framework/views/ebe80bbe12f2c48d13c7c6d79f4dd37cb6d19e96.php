<?php $__env->startSection('content'); ?>

<?php if(Auth::check()): ?>

<?php

// dd($meals); 

?>



<a class="backBtn arrow arrow--right" href="<?php echo e(URL::to('/')); ?>"></a>
<div class="meallistpage__hidden">    
    <h2 class="mealssetting__title">登録した食事</h2>

    <div class="mealtype__linkBtn">
        <?php echo link_to_route('mealssetting.show','食事リスト',[],['class'=>'userRegistBtn']); ?>

        <div class="userRegistBtn mealtype__linkBtn__visit">おやつリスト</div>
        <?php echo link_to_route('drinks.show','飲み物リスト',[],['class'=>'userRegistBtn']); ?>

    </div>
    

    <div class="meallistpage__scroll">

            <div class="itemsList">

            <div class="itemsHead">
                <p>商品名</p>
                <p>カロリー</p>
                <p>内容量</p>
                <p>値段</p>
                <p>タンパク質</p>
                <p>脂質</p>
                <p>炭水化物</p>
                <p>カロリー/量</p>
                <p>円/量</p>
                <!-- <p>カロリー/円</p> -->
                <!-- <p>量/円</p> -->
                <!-- <p>タンパク質/円</p> -->
                <!-- <p>脂質/円</p> -->
                <!-- <p>炭水化物/円</p> -->
            </div>


            <?php $__currentLoopData = $meals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if( $meal['mealType'] === 'おやつ'): ?>

                <a href="<?php echo e(route('mealssetting.updatepage', ['id' => $meal['mealId']])); ?>">
                    <div class="itemsHead">
                        <p><?php echo e($meal['mealName']); ?></p>
                        <p><?php echo e($meal['mealKcal']); ?>kcal</p>
                        
                        <!-- 商品の量の単位がグラムなら -->
                        <?php if( isset($meal['mealGram']) ): ?>
                            <p><?php echo e($meal['mealGram']); ?>g</p>
                        <!-- 商品の量の単位が個数なら -->
                        <?php elseif( isset($meal['mealPiece']) ): ?>
                            <p><?php echo e($meal['mealPiece']); ?>個</p>
                        <?php endif; ?>

                        <p><?php echo e($meal['mealPrice']); ?>円</p>

                        <p><?php echo e($meal['mealProtain']); ?>p</p>
                        <p><?php echo e($meal['mealCarbo']); ?>f</p>
                        <p><?php echo e($meal['mealFat']); ?>c</p>


                        <!-- 商品の量の単位がグラムなら -->
                        <?php if( isset($meal['mealKcalParGram'],) ): ?>
                            <p><?php echo e($meal['mealKcalParGram']); ?>kcal/g</p>
                            <p><?php echo e($meal['mealPriceParGram']); ?>円/g</p>
                            <!-- <p><?php echo e($meal['mealKcalParPrice']); ?>kcal/円</p> -->
                            <!-- <p><?php echo e($meal['mealGramParPrice']); ?>g/円</p> -->
                            <!-- <p><?php echo e($meal['mealProtainParPrice']); ?>p/円</p> -->
                            <!-- <p><?php echo e($meal['mealFatParPrice']); ?>f/円</p> -->
                            <!-- <p><?php echo e($meal['mealCarboParPrice']); ?>c/円</p> -->

                        <!-- 商品の量の単位が個数なら -->
                        <?php elseif( isset($meal['mealKcalParPiece'],) ): ?>
                            <p><?php echo e($meal['mealKcalParPiece']); ?>kcal/個</p>
                            <p><?php echo e($meal['mealPriceParPiece']); ?>円/個</p>
                            <!-- <p><?php echo e($meal['mealKcalParPrice']); ?>kcal/円</p> -->
                            <!-- <p><?php echo e($meal['mealPieceParPrice']); ?>個/円</p> -->
                            <!-- <p><?php echo e($meal['mealProtainParPrice']); ?>p/円</p> -->
                            <!-- <p><?php echo e($meal['mealFatParPrice']); ?>f/円</p> -->
                            <!-- <p><?php echo e($meal['mealCarboParPrice']); ?>c/円</p> -->
                            
                        <?php endif; ?>


                    </div>
                </a>

                <?php endif; ?>  

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    </div>











</div>


<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/snackssetting.blade.php ENDPATH**/ ?>