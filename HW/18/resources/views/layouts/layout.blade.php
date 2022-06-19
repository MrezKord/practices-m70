{{-- @dd($admin) --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('meta')
    @stack('script')
</head>

<body>

    <div class="bg-[url('/image/bg.jfif')] h-[100vh] bg-cover">
        @if ($admin)
            <div>
                @include('adminHeader')
            </div>
        @else
            <div>
                @include('header')
            </div>
        @endif
    
        <div class="w-full" id="qq">
            @yield('main')
        </div>
    </div>


</body>

</html>
