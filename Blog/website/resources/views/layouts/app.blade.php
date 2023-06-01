<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @vite(['resources/css/app.scss',])
</head>
<body>
    <div class="container py-3">
        @include('include/header')
        <main>
            @if (Request::is('/'))
                @include('include/greetings')
            @endif
            <div class="container mt-5">
                @include('include/messages')
                <div class="row">
                    <div class="col-8">
                        @yield('content')
                    </div>
                    <div class="col-4">
                        @include('include/aside')
                    </div>
                </div>
            </div>
            @vite(['resources/js/app.js'])
        </main>
        @include('include/footer')
    </div>
</body>
</html>
