<?php $__env->startSection('content'); ?>

<?php if(Auth::check()): ?>

<a class="backBtn arrow arrow--right" href="<?php echo e(URL::to('/mealssetting')); ?>"></a>
<?php

$url = url()->full();
$keys = parse_url($url); //パース処理
$path = explode("/", $keys['path']); //分割処理
$last = end($path); //最後の要素を取得

?> 





<?php if(count($errors) > 0): ?>
<ul class="alert alert-danger" role="alert">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="ml-4"><?php echo e($error); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php endif; ?>


<style>
    .meal_update_mealname{
        text-align: center;
    }
</style>

<div class="protain_setting__container">

    
    <div class="meal_update_item_photo_path"><img src="<?php echo e($meal->item_photo_path); ?>" width="100%" alt=""></div>

    <div class="meal_update_mealname"><p><?php echo e($meal->name); ?></p></div>


    <?php echo Form::open( ['route' => ['mealssetting.update','id' => $last],'enctype'=>'multipart/form-data','class'=>'mealsupdate' ]); ?>

    <?php echo csrf_field(); ?>


        <p>種別</p>
        <?php echo e(Form::select('type',['食事'=> '食事' ,'飲料'=> '飲料' ,'おやつ'=> 'おやつ'],$meal->type, ['class' => 'form-control'])); ?>

        

        <p>名前</p>
        <?php echo Form::text('name', $meal->name, ['class' => 'form-control','placeholder' => '']); ?>

        

        <?php if( isset($meal->gram) ): ?>

            <style> .piece{display: none;}</style>
                
            <p>種別</p>
            <?php echo e(Form::select('',['gramu '=> 'グラム' ,'piece'=> '個数'], 'gram', ['class' => 'form-control type'])); ?>


            <p class="gram">内容量/g</p>
            <?php echo Form::text('gram', $meal->gram, ['class' => 'form-control gram','placeholder' => '','selected']); ?>


            <p class="piece">内容量/個</p>
            <?php echo Form::text('piece', '', ['class' => 'form-control piece','placeholder' => '']); ?>


        <?php elseif(isset($meal->piece)): ?>

            <style> .gram{display: none;}</style>

            <p>種別</p>
            <?php echo e(Form::select('',['gram'=> 'gram' ,'piece'=> 'kosuu'], 'piece', ['class' => 'form-control type'])); ?>

            

            <p class="gram">内容量/g</p>
            <?php echo Form::text('gram', '', ['class' => 'form-control gram','placeholder' => '','selected']); ?>

            

            <p class="piece">内容量/個</p>
            <?php echo Form::text('piece', $meal->piece, ['class' => 'form-control piece','placeholder' => '']); ?>


        <?php endif; ?>


        <p>価格を入力</p>
        <?php echo Form::text('price', $meal->price, ['class' => 'form-control','placeholder' => '']); ?>

        
        <p>カロリーを入力</p>
        <?php echo Form::text('kcal', $meal->kcal, ['class' => 'form-control','placeholder' => '']); ?>

        
        <p>タンパク質を入力</p>
        <?php echo Form::text('protain', $meal->protain, ['class' => 'form-control','placeholder' => '']); ?>

        
        <p>炭水化物を入力</p>
        <?php echo Form::text('carbo', $meal->carbo, ['class' => 'form-control','placeholder' => '']); ?>

        
        <p>脂質を入力</p>
        <?php echo Form::text('fat', $meal->fat, ['class' => 'form-control','placeholder' => '']); ?>




        <?php echo Form::label('file_name','写真',['class' => 'filename__label']); ?>

        <?php echo Form::file('file_name',['class' => 'filename__form']); ?>

        
    
    <?php echo Form::submit('更新', ['class' => 'submitBtn','id']); ?>

    <?php echo Form::close(); ?>





    <?php echo Form::open(['route' => ['meals.detroy','id' => $last],'method' => 'delete']); ?>

    <?php echo csrf_field(); ?>
    <?php echo Form::submit('この商品を削除', ['class' => 'submitBtn denger','onclick' => 'delete_alert(event);return false;']); ?>

    <?php echo Form::close(); ?>



</div>


<script>
    $(".type").change(function() {
        var type_val = $(".type").val();
            if(type_val == "gram") {
                $('.gram').css('display', 'block');
                $('.piece').css('display', 'none').val(null).val();
            }if(type_val == "piece") {
                $('.gram').css('display', 'none').val(null).val();
                $('.piece').css('display', 'block');
        }
    });


    
    $('.topMealsList__Box').click(function(){  

        var val = $(this).attr('id');
        var mealname = $(this).text();
        
        $('.topMealsList__input').css('display', 'flex');

        $(this).addClass('checked');

        $('.checked').not(this).removeClass('checked');
        
        console.log(mealname);

        $('.mealname').html(mealname);

    });

    $('.mealtype__meal__tab').click(function(){  
        $('.mealtype__meal').css('display','flex');
        $('.mealtype__snack').css('display','none');
        $('.mealtype__drink').css('display','none');

        $(this).addClass('checked');
        $('.checked').not(this).removeClass('checked');

    });

    $('.mealtype__snack__tab').click(function(){  
        $('.mealtype__snack').css('display','flex');
        $('.mealtype__meal').css('display','none');
        $('.mealtype__drink').css('display','none');

        $(this).addClass('checked');
        $('.checked').not(this).removeClass('checked');

    });

    $('.mealtype__drink__tab').click(function(){  
        $('.mealtype__drink').css('display','flex');
        $('.mealtype__snack').css('display','none');
        $('.mealtype__meal').css('display','none');

        $(this).addClass('checked');
        $('.checked').not(this).removeClass('checked');

    });


    function delete_alert(e){
       if(!window.confirm('本当に削除しますか？')){
          return false;
       }
       document.deleteform.submit();
    };



  
    </script>



<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/meal-update.blade.php ENDPATH**/ ?>