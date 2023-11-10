<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma-rtl.min.css">
    <style>
      body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

/* Estilos para la barra de navegación */
nav {
    background-color: #333;
    color: white;
    padding: 10px;
}

nav a {
    text-decoration: none;
    color: white;
    margin: 10px;
}

/* Estilos para contenedor de comandas */
.comanda {
    background-color: #fff;
    padding: 20px;
    margin: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    position: relative;
}

/* Estilos para botones */
button {
    margin: 10px;
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}


/* Estilos para el cuadro de modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.modal-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: transparent;
    border: none;
    font-size: 20px;
    color: #333;
    cursor: pointer;
}




    </style>
    <title>Document</title>
</head>
<?php if(session('success')): ?>
    <h1><?php echo e(session('success')); ?> </h1>
<?php endif; ?>
<h1><?php echo e(session('token')); ?> </h1>

<body>
  <nav>
    <a href="<?php echo e(route('panel')); ?>">Comandes</a>
    <a href="<?php echo e(route('sabates')); ?>">Sabates</a>
    <a href="<?php echo e(route('logoutAdmin')); ?>">Logout</a>

  </nav>
    <?php $__currentLoopData = session()->get('comandes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comanda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="comanda">
            <p><?php echo e($comanda->id); ?></p>
            <p><?php echo e($comanda->usuari); ?></p>
            <p><?php echo e($comanda->estat); ?></p>
            <button class="js-modal-trigger mostrarProductes" data-target="modal-js-mostrar<?php echo e($comanda->id); ?>">Mostrar productes</button>
            <button class="js-modal-trigger" data-target="modal-js-estat<?php echo e($comanda->id); ?>">Editar Estat</button>

            <div id="modal-js-estat<?php echo e($comanda->id); ?>" class="modal">
                <div class="modal-background"></div>

                <div class="modal-content">
                    <div class="box">
                        <button class="modal-close is-large" aria-label="close"></button>

                        <form method='POST' action="<?php echo e(route('updateEstat')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <input type="hidden" name="idComanda" value="<?php echo e($comanda->id); ?>">
                            <input type="text" name="nouEstat">
                            <button type="submit">Guardar</button>
                        </form>

                    </div>
                </div>

            </div>
            <div id="modal-js-mostrar<?php echo e($comanda->id); ?>" class="modal">
                <div class="modal-background"></div>

                <div class="modal-content">
                    <div class="box">
                        <button class="modal-close is-large" aria-label="close"></button>

                        <?php $__currentLoopData = session()->get('lineaComandes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sabata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($sabata->idComanda == $comanda->id): ?>
                        <div class="sabata">
                          <img class="item__img img__lista" src="<?php echo e($sabata->imatge); ?>" height="184" width="184" alt="">
                          <h3 class="item__model"> <?php echo e($sabata->model); ?></h3>
                          <p class="item__color"><?php echo e($sabata->color); ?></p>
                          <p class="item__quantitat">Quantitat: <?php echo e($sabata->quantitat); ?></p>
                          <p class="item__preu">Preu/u: <?php echo e($sabata->preu); ?>€</p>
                        </div>

                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>

            </div>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script>

        function openModal($el) {
            $el.classList.add('is-active');
        }

        function closeModal($el) {
            $el.classList.remove('is-active');
        }

        function closeAllModals() {
            (document.querySelectorAll('.modal') || []).forEach(($modal) => {
                closeModal($modal);
            });
        }


        (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
            const modal = $trigger.dataset.target;
            const $target = document.getElementById(modal);
            $trigger.addEventListener('click', () => {
                openModal($target);
            });
        });

      

        // Add a click event on various child elements to close the parent modal
        (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') ||[]).forEach(($close) => {
            const $target = $close.closest('.modal');

            $close.addEventListener('click', () => {
                closeModal($target);
            });
        });

        // Add a keyboard event to close all modals
        document.addEventListener('keydown', (event) => {
            if (event.code === 'Escape') {
                closeAllModals();
            }
        });
    </script>
</body>

</html>
<?php /**PATH C:\Users\loris\Desktop\holadsada\tr1-takeaway-dawtr1g2-naiki\resources\views/panel.blade.php ENDPATH**/ ?>