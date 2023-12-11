<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        @vite('resources/js/app.js')
        <title>Laravel</title>
        
    </head>
    <body id="app">
       <!-- <example-component></example-component> -->
       <todo-component></todo-component>
    </body>
</html>
