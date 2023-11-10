<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <script
    src="https://unpkg.com/vue@3/dist/vue.global.js">
</script> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css"> </head> <?php $total=0; ?> <body>

<div> <h2>Cesta de la compra</h2>
<?php $__currentLoopData = $lineasComanda; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sabata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$total += $sabata->preu * $sabata->quantitat;
?>
<div>
    <h4><?php echo e($sabata->model); ?></h4>
    <p><?php echo e($sabata->model); ?> </p>
    <p>Quantitat: <?php echo e($sabata->quantitat); ?></p>
    <p>Preu/u: <?php echo e($sabata->preu); ?> €</p>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<p id="checkout-total">Total del Carrito: <?php echo e($total); ?></p>
<div>
    <h2>QR</h2>
    <img class="item__img" src="<?php echo e(public_path('/').$sabata->qr); ?>" height="184" width="184" alt=""> 
</div>
</body>

</html><?php /**PATH C:\Users\loris\Desktop\holadsada\tr1-takeaway-dawtr1g2-naiki\resources\views/comanda.blade.php ENDPATH**/ ?>