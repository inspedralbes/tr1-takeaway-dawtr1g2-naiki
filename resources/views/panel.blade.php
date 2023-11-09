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
@if (session('success'))
    <h1>{{ session('success') }} </h1>
@endif

<body>
  <nav>
    <a href="{{ route('panel') }}">Comandes</a>
    <a href="{{ route('sabates') }}">Sabates</a>
    <a href="{{ route('logoutAdmin') }}">Logout</a>

  </nav>
    @foreach (session()->get('comandes') as $comanda)
        <div class="comanda">
            <p>{{ $comanda->id }}</p>
            <p>{{ $comanda->usuari }}</p>
            <p>{{ $comanda->estat }}</p>
            <button class="js-modal-trigger mostrarProductes" data-target="modal-js-mostrar{{ $comanda->id }}">Mostrar productes</button>
            <button class="js-modal-trigger" data-target="modal-js-estat{{ $comanda->id }}">Editar Estat</button>

            <div id="modal-js-estat{{ $comanda->id }}" class="modal">
                <div class="modal-background"></div>

                <div class="modal-content">
                    <div class="box">
                        <button class="modal-close is-large" aria-label="close"></button>

                        <form method='POST' action="{{ route('updateEstat') }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="idComanda" value="{{ $comanda->id }}">
                            <input type="text" name="nouEstat">
                            <button type="submit">Guardar</button>
                        </form>

                    </div>
                </div>

            </div>
            <div id="modal-js-mostrar{{ $comanda->id }}" class="modal">
                <div class="modal-background"></div>

                <div class="modal-content">
                    <div class="box">
                        <button class="modal-close is-large" aria-label="close"></button>

                        @foreach (session()->get('lineaComandes') as $sabata)
                        @if($sabata->idComanda == $comanda->id)
                        <div class="sabata">
                          <img class="item__img img__lista" src="{{$sabata->imatge}}" height="184" width="184" alt="">
                          <h3 class="item__model"> {{$sabata->model}}</h3>
                          <p class="item__color">{{$sabata->color}}</p>
                          <p class="item__quantitat">Quantitat: {{$sabata->quantitat}}</p>
                          <p class="item__preu">Preu/u: {{$sabata->preu}}€</p>
                        </div>

                        @endif
                        @endforeach

                    </div>
                </div>

            </div>

        </div>
    @endforeach
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
