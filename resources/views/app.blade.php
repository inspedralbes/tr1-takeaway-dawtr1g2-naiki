<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if (session('error'))
  <h1> {{session('error')}}</h1>
  @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        @method ('POST')
        <label for="email">Email</label>
        <input type="email" name="email">
        <label for="password">Password</label>
        <input type="password" name="password">
        <button type="submit">Login</button>
    </form>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        @method ('POST')
        <input type="text" name="name">
        <input type="email" name="email">
        <input type="password" name="password">
        <input type="password" name="password_confirmation">
        <button type="submit">Register</button>
    </form>
</body>
</html>