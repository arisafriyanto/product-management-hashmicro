<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('styles')
</head>

<body>
    <div>
        @include('includes._alert')

        @yield('content')
    </div>

    <script src="https://kit.fontawesome.com/a0e02f3834.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.classList.add('fade');
                    alert.classList.remove('show');
                });
            }, 3000);
        });
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('scripts')
</body>

</html>
