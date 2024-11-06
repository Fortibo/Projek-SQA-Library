<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')
    <title> wewewe</title>
</head>
<body>
    <div>
        @include('nav')
    </div>
    <div>
        @yield('konten')
    </div>
</body>
</html>