<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <script
    src="https://unpkg.com/vue@3/dist/vue.global.js">
</script> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css"> </head> @php $total=0; @endphp <body>

<div> <h2>Cesta de la compra</h2>
@foreach ($lineasComanda as $sabata)
@php
$total += $sabata->preu * $sabata->quantitat;
@endphp
<div>
    <h4>{{$sabata->model}}</h4>
    <p>{{$sabata->model}} </p>
    <p>Quantitat: {{$sabata->quantitat}}</p>
    <p>Preu/u: {{$sabata->preu}} €</p>
</div>
@endforeach
<p id="checkout-total">Total del Carrito: {{$total}}</p>
<div>
    <h2>QR</h2>
    <img class="item__img" src="{{ public_path('/').$sabata->qr }}" height="184" width="184" alt=""> 
</div>
</body>

</html>