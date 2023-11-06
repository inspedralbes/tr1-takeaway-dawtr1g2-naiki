<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma-rtl.min.css">

<title>Document</title> 
</head>

  <body> @foreach ($comandes as $comanda) @if (session('success')) 
    <h1>{{session('success')}} </h1> 
    @endif 
    <div class="comanda"> 
      <p>{{$comanda->id}}</p> 
    <p>{{$comanda->usuari}}</p>
     <p>{{$comanda->estat}}</p> 
     <button id="mostrar-{{$comanda->id}}">Mostrar comanda</button>
    <button class="js-modal-trigger" data-target="modal-js-estat{{$comanda->id}}">Editar Estat</button>

    <div id="modal-js-estat{{$comanda->id}}" class="modal">
      <div class="modal-background"></div>

      <div class="modal-content">
        <div class="box">
        <button class="modal-close is-large" aria-label="close"></button>
        <form method='POST' action="{{route('updateEstat')}}">
          @csrf
          @method('POST')
          <input type="hidden" name="idComanda" value="{{$comanda->id}}">
          <input type="text" name="nouEstat">
          <button type="submit">Guardar</button>
        </form>

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
      (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
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