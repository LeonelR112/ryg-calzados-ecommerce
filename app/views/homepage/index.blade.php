<!DOCTYPE html>
<html lang="Es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{cssFile('styles', false)}}
    <title>{{$titulo}}</title>
</head>
<body>
    <h1>{{$titulo}}</h1>
    <a href="{{route("algunaparte")}}">Un link</a>
    <hr>
    {{jsFile('main')}}
</body>
</html>

