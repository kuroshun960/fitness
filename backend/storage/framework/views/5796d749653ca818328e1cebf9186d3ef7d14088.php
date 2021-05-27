<?php $__env->startSection('content'); ?>
<div class="login__container">

    <div class="text-center">
        <h2 class="login__title">新規登録</h2>
    </div>

    <div class="login__form__container">
        <div class="">

            <?php echo Form::open(['route' => 'signup.post']); ?>

                <div class="form-group">
                    <?php echo Form::label('name', '氏名', ['class' => 'form-title']); ?>

                    <?php echo Form::text('name', old('name'), ['class' => 'form-control']); ?>

                </div>

                <div class="form-group">
                    <?php echo Form::label('email', 'メールアドレス', ['class' => 'form-title']); ?>

                    <?php echo Form::email('email', old('email'), ['class' => 'form-control']); ?>

                </div>

                <div class="form-group">
                    <?php echo Form::label('password', 'パスワード', ['class' => 'form-title']); ?>

                    <?php echo Form::password('password', ['class' => 'form-control']); ?>

                </div>

                <div class="form-group">
                    <?php echo Form::label('password_confirmation', 'パスワード(確認用)', ['class' => 'form-title']); ?>

                    <?php echo Form::password('password_confirmation', ['class' => 'form-control']); ?>

                </div>

                <?php echo Form::submit('新規登録', ['class' => 'btn btn-primary login__btn']); ?>

            <?php echo Form::close(); ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /work/resources/views/auth/register.blade.php ENDPATH**/ ?>