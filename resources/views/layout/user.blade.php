<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/user.css">
</head>
<body>
    @include('layout.component.user.sidebar')
    
    @include('layout.component.user.navbar')

    <main class="content">
        @yield('content')

        @include('layout.component.notification')
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $(".dropdown").click(function(){
                if (!$(this).is($('.dropdown.active').eq(0))) {
                    $('.dropdown.active').eq(0).removeClass("active");
                }
                $(this).toggleClass("active");
            });
        });

        function formatRupiah(uang){
            uang = uang.replace(/\./g, "");
            return parseInt(uang).toLocaleString(['ban','id']);
        }
    </script>
    @yield('script')
</body>
</html>