<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])
</head>
<body class="antialiased">

<main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
    <div class="container">

        <!-- Page heading -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block" rel="home">
                <img src="{{ \Illuminate\Support\Facades\Vite::image('logo.svg') }}"
                     class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]" alt="CutCode">
            </a>
        </div>
        @if($message = flash()->get())
            <div class="{{ $message->class() }} p-5">
                {{ $message->message() }}
            </div>
        @endif

        @auth
            <form method="post" action="{{ route('logout') }}">
                @method('DELETE')
                @csrf

                <button type="submit">{{ __('Logout') }}</button>
            </form>
        @endauth
        @yield('content')
    </div>
</main>
</body>
</html>
