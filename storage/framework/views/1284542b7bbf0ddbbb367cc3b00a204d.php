<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php if(session('error')): ?>
  <h1> <?php echo e(session('error')); ?></h1>
  <?php endif; ?>
    <form action="<?php echo e(route('loginAdmin')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('POST'); ?>
        
        <label for="email">Email</label>
        <input type="email" name="email">
        <label for="password">Password</label>
        <input type="password" name="password">
        <button type="submit">Login</button>
    </form>
</body>
</html><?php /**PATH C:\Users\loris\Desktop\holadsada\tr1-takeaway-dawtr1g2-naiki\resources\views/app.blade.php ENDPATH**/ ?>