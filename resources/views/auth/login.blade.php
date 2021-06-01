<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master SPDP</title>
    <link rel="stylesheet" href="{{ asset('css') }}/style.css">
    <link rel="stylesheet" href="{{ asset('css') }}/card.css">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('landing') }}/img/favicon.ico">
    <link href="{{ asset('material') }}/css/material-dashboard.css" rel="stylesheet" />
</head>
<body>
    {{-- <div class="text">SELAMAT DATANG</div> --}}

    <section id="particles-js">
    </section>

    {{-- @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 bg-gray-200 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700">Register</a>
                @endif
            @endif
        </div>
    @endif --}}

    <x-guest-layout>
        <x-jet-authentication-card>
            <x-slot name="logo">
                <img src="{{ asset('assets/Udinus.png') }}" alt="Logo" class="block h-28 w-auto">
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <h3 class="card-title text-center mb-2">Selamat Datang</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <div class="exp">
                        <div class="checkbox">
                            <input type="checkbox" id="remember_me" name="remember" />
                            <label class="bunder" for="remember_me">
                            <span><!-- This span is needed to create the "checkbox" element --></span>Remember me
                            </label>
                        </div>
                     </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-jet-button class="ml-4">
                        {{ __('Login') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </x-guest-layout>

    {{-- JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js') }}/particles.js"></script>
    <script src="{{ asset('js') }}/setting-particles.js"></script>
    <script>
        $('button').click(function(){
            $('button').toggleClass('active');
            $('.title').toggleClass('active');
            $('nav').toggleClass('active');
        });

        var text = $('.text').text(),
            textArr = text.split('');

        $('.text').html('');

        $.each(textArr, function(i, v){
            if(v == ' '){$('.text').append('<span class="space"></span>');}
            $('.text').append('<span>'+v+'</span>');
        })
    </script>
</body>
</html>
