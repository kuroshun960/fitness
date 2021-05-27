<?php $__env->startSection('content'); ?>



<?php if(count($errors) > 0): ?>
<ul class="alert alert-danger" role="alert">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="ml-4"><?php echo e($error); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php endif; ?>


<div class="login__container">

    <div class="text-center">
        <h2 class="login__title">ログイン</h2>
    </div>

    <div class="login__form__container">
        <div class="">

            <?php echo Form::open(['route' => 'login.post']); ?>

                <div class="form-group">
                    <?php echo Form::label('email', 'メールアドレス', ['class' => 'form-title']); ?>

                    <?php echo Form::email('email', old('email'), ['class' => 'form-control']); ?>

                </div>

                <div class="form-group">
                    <?php echo Form::label('password', 'パスワード', ['class' => 'form-title']); ?>

                    <?php echo Form::password('password', ['class' => 'form-control']); ?>

                </div>

                <?php echo Form::submit('ログイン', ['class' => 'login__btn']); ?>

            <?php echo Form::close(); ?>


            
            <p class="mt-2 mini__link">アカウントをお持ちでない方は<span class=""><?php echo link_to_route('signup.get', 'こちら'); ?></span></p>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/auth/login.blade.php ENDPATH**/ ?>