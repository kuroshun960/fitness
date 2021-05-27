<?php $__env->startSection('content'); ?>

<?php if(Auth::check()): ?>



<?php if(count($errors) > 0): ?>
<ul class="alert alert-danger" role="alert">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="ml-4"><?php echo e($error); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php endif; ?>


<a class="backBtn arrow arrow--right" href="<?php echo e(URL::to('/')); ?>"></a>


<div class="protain_setting__container">

    <h2 class="mealssetting__title">プロテインの栄養価情報を登録します</h2>

    <?php echo Form::open(['route' => 'protainsettings.setting']); ?>

    <?php echo csrf_field(); ?>



    <?php if($regist_protain === null): ?>

    <p>プロテインのメーカー</p>
    <?php echo Form::text('name', '', ['class' => 'form-control','placeholder' => 'メーカー名']); ?>


    <p>１杯あたりのカロリーを入力</p>
    <?php echo Form::text('kcal','', ['class' => 'form-control','placeholder' => 'カロリー']); ?>


    <p>１杯あたりのタンパク質を入力</p>
    <?php echo Form::text('protain','' , ['class' => 'form-control','placeholder' => 'タンパク質']); ?>


    <p>１杯あたりの炭水化物を入力</p>
    <?php echo Form::text('carbo','' , ['class' => 'form-control','placeholder' => '炭水化物']); ?>

    
    <p>１杯あたりの脂質を入力</p>
    <?php echo Form::text('fat','' , ['class' => 'form-control','placeholder' => '脂質']); ?>

    
    <?php echo Form::submit('設定', ['class' => 'submitBtn']); ?>

    <?php echo Form::close(); ?>

    
    <?php else: ?>

    <p>プロテインのメーカー</p>
    <?php echo Form::text('name', $regist_protain->name, ['class' => 'form-control','placeholder' => 'メーカー名']); ?>


    <p>１杯あたりのカロリーを入力</p>
    <?php echo Form::text('kcal',$regist_protain->kcal , ['class' => 'form-control','placeholder' => 'カロリー']); ?>


    <p>１杯あたりのタンパク質を入力</p>
    <?php echo Form::text('protain',$regist_protain->protain  , ['class' => 'form-control','placeholder' => 'タンパク質']); ?>


    <p>１杯あたりの炭水化物を入力</p>
    <?php echo Form::text('carbo',$regist_protain->carbo , ['class' => 'form-control','placeholder' => '炭水化物']); ?>

    
    <p>１杯あたりの脂質を入力</p>
    <?php echo Form::text('fat',$regist_protain->fat , ['class' => 'form-control','placeholder' => '脂質']); ?>

    
    <?php echo Form::submit('設定', ['class' => 'submitBtn']); ?>

    <?php echo Form::close(); ?>


    <?php endif; ?>



</div>


<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/protainsettings.blade.php ENDPATH**/ ?>