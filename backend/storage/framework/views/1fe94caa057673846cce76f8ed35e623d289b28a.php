<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>MY-BODY</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">


        
        <?php
            $randum = date('Ymd-Hi');
        ?>

        
        <link rel="stylesheet" href="<?php echo e(asset('/css/reset.css?'.$randum)); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('/css/style.css?'.$randum)); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('/css/pc.css?3323'.$randum)); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('/css/phone.css?3323'.$randum)); ?>">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
    </head>




    <body>

        
        <?php echo $__env->make('commons.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <?php echo $__env->yieldContent('content'); ?>

        <script>
            //ナビのドロップダウンメニューの表示 
            $('.userSetting').click(function(){  
                $('.userSetting__list').fadeIn(80);
            });
            
            //ドロップダウンメニュー外クリックでメニュー非表示
            $(document).on('click touchend', function(event) {
                if (!$(event.target).closest('.userSetting').length) {
                    $('.userSetting__list').fadeOut(80);
                }
            });
        </script>

        

        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    
        
    </body>
</html><?php /**PATH /work/resources/views/layouts/app.blade.php ENDPATH**/ ?>