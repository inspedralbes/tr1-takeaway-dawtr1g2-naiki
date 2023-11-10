<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width,
    initial-scale=1.0"> <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="style.css"> <title>Document</title> <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma-rtl.min.css">

<style> body { font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 0; padding: 0; } nav {
    background-color: #333; color: white; padding: 10px; } nav a { text-decoration: none; color: white; margin:
    10px; } /* Formulario de creación de sabata */ form { background-color: #fff; padding: 20px; margin: 20px;
    border-radius: 5px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); } label { display: block; margin-top: 10px;
    font-weight: bold; } input[type="text"],  select { width: 100%; padding: 10px; margin-top: 5px; border: 1px
    solid #ccc; border-radius: 5px; } button { background-color: #333; color: white; padding: 10px 20px; border: none;
    border-radius: 5px; cursor: pointer; margin-top: 10px; } button:hover { background-color: #555; } /* Lista de
    sabates */ .sabata { background-color: #fff; padding: 10px; margin: 10px; border-radius: 5px; box-shadow: 0 0 5px
    rgba(0, 0, 0, 0.2); display: inline-block; width: 200px; text-align: center; } .item__img { max-width: 100%; }
    .item__model { font-weight: bold; margin: 10px 0; } .item__color { color: #777; } .item__preu { font-weight: bold;
    margin: 10px 0; } </style>
    </head>

    <body>
        <nav>
            <a href="<?php echo e(route('panel')); ?>">Comandes</a>
            <a href="<?php echo e(route('sabates')); ?>">Sabates</a>
            <a href="<?php echo e(route('logoutAdmin')); ?>">Logout</a>
        </nav>
        <form method="POST" enctype="multipart/form-data" action="<?php echo e(route('crearSabata')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field("POST"); ?>
            <label for="marca">Marca</label>
            <input type="text" name="marca">
            <label for="model">Model</label>
            <input type="text" name="model">
            <label for="genere">Genere</label>
            <select name="genere" id="selectGenere">
                <option value="Home">Home</option>
                <option value="Dona">Dona</option>
                <option value="Nen/a">Nen/a</option>
            </select>
            <label for="preu">Preu</label>
            <input type="text" name="preu">
            <label for="talles">Talles</label>
            <input type="text" name="talles">
            <label for="color">Color</label>
            <input type="text" name="color">
            <label for="img">Imatge</label>
            <input type="file" name="img">
            <button type="submit">Crear</button>
        </form>
        <?php $__currentLoopData = session('sabates'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sabata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="sabata">
            <img class="item__img img__lista" src="<?php echo e($sabata->imatge); ?>" height="184" width="184" alt="">
            <h3 class="item__model"> <?php echo e($sabata->model); ?></h3>
            <p class="item__color"><?php echo e($sabata->color); ?></p>
            <p class="item__preu">Preu/u: <?php echo e($sabata->preu); ?>€</p>
            <button class="js-modal-trigger danger" data-target="modal-js-sabata<?php echo e($sabata->id); ?>">Editar</button>

            <div id="modal-js-sabata<?php echo e($sabata->id); ?>" class="modal">
                <div class="modal-background"></div>

                <div class="modal-content">
                    <div class="box">
                        <button class="modal-close is-large" aria-label="close"></button>

                        <form method='POST' enctype="multipart/form-data" action="<?php echo e(route('updateSabata')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <input type="hidden" name="idSabata" value="<?php echo e($sabata->id); ?>">

                            <label for="marca">Marca:</label>
                            <input type="text" name="marca" value="<?php echo e($sabata->marca); ?>" required>

                            <label for="model">Model:</label>
                            <input type="text" name="model" value="<?php echo e($sabata->model); ?>" required>

                            <label for="genere">Género:</label>
                            <input type="text" name="genere" value="<?php echo e($sabata->genere); ?>" required>

                            <label for="preu">Preu:</label>
                            <input type="number" name="preu" value="<?php echo e($sabata->preu); ?>" required>

                            <label for="talles">Talles:</label>
                            <input type="text" name="talles" value="<?php echo e($sabata->talles); ?>" required>

                            <label for="color">Color:</label>
                            <input type="text" name="color" value="<?php echo e($sabata->color); ?>" required>
                            
                            <label for="img">Imatge</label>
                            <input type="file" name="img">
                            <button type="submit">Guardar</button>
                        </form>

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

    </html><?php /**PATH C:\Users\loris\Desktop\holadsada\tr1-takeaway-dawtr1g2-naiki\resources\views/sabates.blade.php ENDPATH**/ ?>