<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Hello  {{$user->name}}</h2>
    <p>To verify your account , please check the link below</p>
    </hr>
   <a href="{{route('user.verify' , $user->VerfiUser->token)}}">verify your email </a>
    <hr/>
</body>
</html>