<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>{{$sessio['user']->name}}</h1>
    <div class="comanda">
        <p>ID</p>
        <p>Email</p>
        <p>Estat</p>
    </div>
    @foreach ($comandes as $comanda)
    
    <div class="comanda">
        <p>{{$comanda->id}}</p>
        <p>{{$comanda->usuari}}</p>
        <p>{{$comanda->estat}}</p>
    </div>
    @endforeach
</body>
</html>