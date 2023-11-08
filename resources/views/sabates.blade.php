<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

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

/* Formulario de creación de sabata */
form {
    background-color: #fff;
    padding: 20px;
    margin: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

input[type="text"],
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background-color: #555;
}

/* Lista de sabates */
.sabata {
    background-color: #fff;
    padding: 10px;
    margin: 10px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    display: inline-block;
    width: 200px;
    text-align: center;
}

.item__img {
    max-width: 100%;
}

.item__model {
    font-weight: bold;
    margin: 10px 0;
}

.item__color {
    color: #777;
}

.item__preu {
    font-weight: bold;
    margin: 10px 0;
}
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('panel') }}">Comandes</a>
        <a href="{{ route('sabates') }}">Sabates</a>
      </nav>
    <form method="POST" action="{{route('crearSabata')}}">
        @csrf
        @method("POST")
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
        <button type="submit">Crear</button>
    </form>
    @foreach (session('sabates') as $sabata )
    <div class="sabata">
        <img class="item__img img__lista" src="{{$sabata->imatge}}" height="184" width="184" alt="">
        <h3 class="item__model"> {{$sabata->model}}</h3>
        <p class="item__color">{{$sabata->color}}</p>
        <p class="item__preu">Preu/u: {{$sabata->preu}}€</p>
    </div>
        
    @endforeach
</body>
</html>