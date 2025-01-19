{{-- resources/views/app.blade --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- Top Header Section --}}
    <header>
        @yield('top-header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @yield('bottom-header')
    </footer>
</body>
</html>
