<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="{{ asset('material') }}/css/material-dashboard.css" rel="stylesheet" />
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('landing/img/favicon.ico') }}">

        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <style>
            .swal-button:not([disabled]):hover{
                background-color: transparent;
                color: black;
            }
            .swal-button--confirm {
                padding: 7px 19px;
                border-radius: 2px;
                background-color: #2b6de7;
                font-size: 12px;
                border: 1px solid #2456d3;
                text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
            }
            .swal-button--kp {
                padding: 7px 19px;
                border-radius: 2px;
                background-color: #2b86e7;
                font-size: 12px;
                border: 1px solid #2470d3;
                text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
            }
            .swal-button--ta {
                padding: 7px 19px;
                border-radius: 2px;
                background-color: #2b86e7;
                font-size: 12px;
                border: 1px solid #2470d3;
                text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
            }
            .swal-button--cancel {
                padding: 7px 19px;
                border-radius: 2px;
                background-color: #e8e8e8;
                font-size: 12px;
                border: 1px solid #383838;
                text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
                color: black;
            }
            .swal-button--hapus {
                padding: 7px 19px;
                border-radius: 2px;
                background-color: #b34954;
                font-size: 12px;
                border: 1px solid #9a3e3e;
                text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
                color: white;
            }
            .swal-button--hapus:hover {
                background-color: #e14a59;
            }
        </style>
        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    </head>
    <body class="font-sans antialiased bg-cool-gray-200">
        <div class="min-h-screen bg-gray-200">

            <div id="loader-wrapper">
                <div id="loader"></div>

                <div class="loader-section section-left"></div>
                <div class="loader-section section-right"></div>

            </div>
            <div>
                <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
                    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-10 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

                    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-20 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
                        <div class="flex items-center justify-center mt-8 ">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/Udinus.png') }}" alt="Logo" class="block h-9 w-auto bg-gray-200 rounded-2xl">

                                <span class="text-white text-2xl mx-2 font-semibold">Mahasiswa</span>
                            </div>
                        </div>

                        <nav class="mt-10">
                            <x-jet-nav-link href="{{ route('dashboard') }}" class="w-full flex items-center mt-3 py-3 px-6 text-white
                                hover:bg-gray-700 no-underline hover:no-underline" :active="request()->routeIs('dashboard')">
                                <i class="material-icons h-6 w-6 ml-4 mr-3">dashboard</i>
                                {{ __('Dashboard') }}
                            </x-jet-nav-link>

                            <div x-data="{ open: false }">
                                <x-jet-nav-link @click="open = !open" class="w-full flex justify-between items-center mt-3 py-3 px-6 text-white cursor-pointer hover:bg-gray-700
                                    focus:outline-none" :active="request()->routeIs(['tahunajaran', 'dosen'])">
                                    <span class="flex items-center">
                                        <i class="material-icons h-6 w-6 ml-4 -mr-1">school</i>

                                        <span class="mx-4 font-medium">{{ __('Setting') }}</span>
                                    </span>

                                    <span>
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                                            <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </x-jet-nav-link>

                                <div x-show="open">
                                    <a class="py-2 px-10 block text-sm text-gray-100 hover:bg-blue-500 hover:text-white no-underline hover:no-underline" href="{{ route('tahunajaran') }}">
                                        {{ __('Tahun Ajaran') }}
                                    </a>
                                    <a class="py-2 px-10 block text-sm text-gray-100 hover:bg-blue-500 hover:text-white no-underline hover:no-underline" href="{{ route('dosen') }}">
                                        {{ __('Dosen') }}
                                    </a>
                                </div>
                            </div>

                            <div x-data="{ open: false }">
                                <x-jet-nav-link @click="open = !open" class="w-full flex justify-between items-center mt-3 py-3 px-6 text-white cursor-pointer hover:bg-gray-700
                                    focus:outline-none" :active="request()->routeIs(['koorkp', 'koortah'])">
                                    <span class="flex items-center">
                                        <i class="material-icons h-6 w-6 ml-4 -mr-1">how_to_reg</i>

                                        <span class="mx-4 font-medium">{{ __('Koordinator') }}</span>
                                    </span>

                                    <span>
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                                            <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </x-jet-nav-link>

                                <div x-show="open">
                                    <a class="py-2 px-10 block text-sm text-gray-100 hover:bg-blue-500 hover:text-white no-underline hover:no-underline" href="{{ route('koorkp') }}">
                                        {{ __('Koordinator KP') }}
                                    </a>
                                    <a class="py-2 px-10 block text-sm text-gray-100 hover:bg-blue-500 hover:text-white no-underline hover:no-underline" href="{{ route('koortah') }}">
                                        {{ __('Koordinator TA') }}
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="flex-1 flex flex-col overflow-hidden">
                        <header class="flex justify-between items-center sm:py-2 sm:px-3 md:py-3 md:px-3 lg:py-4 lg:px-3 h-24 bg-white border-b-4 border-indigo-600">
                            <div class="flex items-center">
                                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </button>

                                <div class="relative mx-4 lg:mx-0 font-semibold">
                                    {{ now()->isoFormat('dddd, D MMMM Y') }}
                                    {{-- {{ Auth::user()->name }} --}}
                                </div>
                            </div>

                            <div class="flex items-center">

                                <div class="flex items-center mr-2">
                                    <x-jet-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                    <img class="h-12 w-12 md:h-14 md:w-14 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                                </button>
                                            @else
                                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                    <div>{{ Auth::user()->name }}</div>

                                                    <div class="ml-1">
                                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </button>
                                            @endif
                                        </x-slot>

                                        <x-slot name="content">
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Account') }}
                                            </div>

                                            <x-jet-dropdown-link href="{{ route('profile.show') }}" class="no-underline hover:no-underline">
                                                {{ __('Profile') }}
                                            </x-jet-dropdown-link>

                                            @if (Route::has('register'))
                                                <x-jet-dropdown-link href="#" data-toggle="modal" data-target="#regisModel">
                                                    {{ __('Add Master') }}
                                                </x-jet-dropdown-link>
                                            @endif

                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                                    {{ __('API Tokens') }}
                                                </x-jet-dropdown-link>
                                            @endif

                                            <div class="border-t border-gray-100"></div>

                                            <!-- Team Management -->
                                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Manage Team') }}
                                                </div>

                                                <!-- Team Settings -->
                                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                    {{ __('Team Settings') }}
                                                </x-jet-dropdown-link>

                                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                    <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                                        {{ __('Create New Team') }}
                                                    </x-jet-dropdown-link>
                                                @endcan

                                                <div class="border-t border-gray-100"></div>

                                                <!-- Team Switcher -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Switch Teams') }}
                                                </div>

                                                @foreach (Auth::user()->allTeams() as $team)
                                                    <x-jet-switchable-team :team="$team" />
                                                @endforeach

                                                <div class="border-t border-gray-100"></div>
                                            @endif

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-jet-dropdown-link href="{{ route('logout') }}" class="no-underline hover:no-underline"
                                                                    onclick="event.preventDefault();
                                                                                this.closest('form').submit();">
                                                    {{ __('Logout') }}
                                                </x-jet-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-jet-dropdown>
                                </div>
                            </div>
                        </header>
                        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                            @livewire('tahunajaran')
                        </main>
                    </div>
                </div>
            </div>
        </div>

        @stack('modals')
        <!-- Modal -->
        <div class="modal fade" id="regisModel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('addMaster') }}">
                            @csrf

                            <div>
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password" value="{{ __('Password') }}" />
                                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-jet-button class="ml-4">
                                    {{ __('Add') }}
                                </x-jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" ></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @livewireScripts
        @include('sweetalert::alert')
        @stack('scripts')
        {{-- @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"]) --}}
        <script>
            window.addEventListener('swal',function(e){
                Swal.fire(e.detail);
            });
        </script>
    </body>
</html>
