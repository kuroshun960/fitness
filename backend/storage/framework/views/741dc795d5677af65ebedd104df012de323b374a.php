<?php $__env->startSection('content'); ?>

<?php if(Auth::check()): ?>


<?php
    $job_name_loop = [

    ];
?>

<?php if(count($errors) > 0): ?>
        <ul class="alert alert-danger" role="alert">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="ml-4"><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>


<a class="backBtn arrow arrow--right" href="<?php echo e(URL::to('/')); ?>"></a>


<div class="personal_setting__container">

    <h2 class="mealssetting__title">個人設定</h2>

    <?php echo Form::open(['route' => 'personalsettings.setting']); ?>

    <?php echo csrf_field(); ?>

    <p>名前</p>
    <?php echo Form::text('name', Auth::user()->name, ['class' => 'form-control','placeholder' => '']); ?>


    <p>年齢</p>
    <?php echo Form::text('age', Auth::user()->age, ['class' => 'form-control','placeholder' => '']); ?>


    <p>身長</p>
    <?php echo Form::text('height', Auth::user()->height, ['class' => 'form-control','placeholder' => '']); ?>

    
    <p>性別</p>
    <?php echo e(Form::select('sex',['男性'=> '男性' ,'女性'=> '女性' ,], Auth::user()->sex, ['class' => 'my_class'])); ?>

    
    <p>目標は増量 / 減量（ダイエット）のどちらですか？</p>
    <?php echo e(Form::select('IncreaseOrDecrease',['増量期'=> '増量' ,'減量期'=> '減量' ,], null, ['class' => 'my_class'])); ?>


    <p>日常の運動量はどんなもんですか？</p>
    <?php echo e(Form::select('HardOrSoft',
    ['soft'=> '生活の大部分座ってる/事務' ,'middle'=> '立って移動や作業や運動する/接客・通勤・家事' ,'hard'=> '運動量の多い仕事/スポーツマン' ,],
    null, ['class' => 'my_class'])); ?>

    

    <p>日あたりの目標摂取カロリー</p>
    <?php echo Form::text('kcalParday', Auth::user()->kcalParday, ['class' => 'form-control','placeholder' => '']); ?>


    <?php echo Form::submit('設定', ['class' => 'submitBtn']); ?>

    <?php echo Form::close(); ?>


</div>

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/personalsettings.blade.php ENDPATH**/ ?>