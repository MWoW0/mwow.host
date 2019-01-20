<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-lightest bg-cover bg-no-repeat h-screen antialiased">
    <div id="app">
        <nav class="bg-grey-lighter shadow h-12 mb-8 px-6 md:px-0">
            <div class="container mx-auto h-full">
                <div class="flex items-center justify-center h-12">
                    <div class="mr-6">
                        <a href="{{ url('/') }}" class="text-lg font-hairline text-teal-darker no-underline hover:underline">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="flex-1 text-left">
                        <a href="{{ url('/faq') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker">
                            {{ __('FAQ') }}
                        </a>

                        <a href="{{ url('/about') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker">
                            {{ __('About') }}
                        </a>

                        <a href="{{ url('/community') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker">
                            {{ __('Community') }}
                        </a>
                    </div>

                    <div class="flex-1 text-right">
                        @auth
                            <a href="{{ url('/home') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker">{{ __('Home') }}</a>
                            <a href="{{ url('/nova') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker">{{ __('Admin') }}</a>
                            {{--<a href="{{ url('/horizon') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker">{{ __('Queue') }}</a>--}}

                            <a href="{{ route('logout') }}"
                               class="no-underline hover:underline text-teal-darker text-sm"
                               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase pr-6">{{ __('Login') }}</a>
                            <a href="{{ route('register') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase">{{ __('Register') }}</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <footer class="bg-grey-lightest py-8 w-full">
        <div class="container mx-auto px-8">
            <div class="table w-full">
                <div class="block sm:table-cell">
                    <p class="uppercase text-teal-darker-darker text-sm sm:mb-6">Links</p>
                    <ul class="list-reset text-xs mb-6">
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="#" class="text-teal-darker hover:text-black no-underline hover:underline">FAQ</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="#" class="text-teal-darker hover:text-black no-underline hover:underline">Help</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="#" class="text-teal-darker hover:text-black no-underline hover:underline">Support</a>
                        </li>
                    </ul>
                </div>
                <div class="block sm:table-cell">
                    <p class="uppercase text-teal-darker-darker text-sm sm:mb-6">Social</p>
                    <ul class="list-reset text-xs mb-6">
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="#" class="text-teal-darker hover:text-black no-underline hover:underline">Facebook</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="#" class="text-teal-darker hover:text-black no-underline hover:underline">Linkedin</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="#" class="text-teal-darker hover:text-black no-underline hover:underline">Twitter</a>
                        </li>
                    </ul>
                </div>
                <div class="block sm:table-cell">
                    <p class="uppercase text-teal-darker-darker text-sm sm:mb-6">Server</p>
                    <ul class="list-reset text-xs mb-6">
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="{{ url('/blog') }}" class="text-teal-darker hover:text-black no-underline hover:underline">Blog</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="{{ url('/about') }}" class="text-teal-darker hover:text-black no-underline hover:underline">About Us</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="{{ url('/contact') }}" class="text-teal-darker hover:text-black no-underline hover:underline">Contact</a>
                        </li>
                    </ul>
                </div>

                <div class="block sm:table-cell">
                    <p class="uppercase text-teal-darker-darker text-sm sm:mb-6">Community</p>
                    <ul class="list-reset text-xs mb-6">
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="{{ url('/community') }}" class="text-teal-darker hover:text-black no-underline hover:underline">Forum</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 sm:block sm:mr-0">
                            <a href="{{ url('/bugs') }}" class="text-teal-darker hover:text-black no-underline hover:underline">Bug Tracker</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
