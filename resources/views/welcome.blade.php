<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">s

    <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>


        <div class="min-h-screen bg-gray-50 py-6 flex flex-col justify-center relative overflow-hidden sm:py-12">
            <img src="/img/beams.jpg" alt="" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 max-w-none" width="1308" />
            <div class="absolute inset-0 bg-[url(/img/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
            <div class="relative px-6 pt-10 pb-8 bg-white shadow-xl ring-1 ring-gray-900/5 sm:max-w-lg sm:mx-auto sm:rounded-lg sm:px-10">
                <div class="max-w-md mx-auto">
                    <img src="/img/logo.svg" class="h-6" alt="Tailwind Play" />
                    <div class="divide-y divide-gray-300/50">
                        <div class="py-8 text-base leading-7 space-y-6 bg-red-600 text-gray-600">
                            <p>An advanced online playground for Tailwind CSS, including support for things like:</p>
                            <ul class="space-y-4">
                                <li class="flex items-center">
                                    <svg class="w-6 h-6 flex-none fill-sky-100 stroke-sky-500 stroke-2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="11" />
                                        <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                    </svg>
                                    <p class="ml-4">
                                        Customizing your
                                        <code class="text-sm font-bold text-gray-900">tailwind.config.js</code> file
                                    </p>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-6 h-6 flex-none fill-sky-100 stroke-sky-500 stroke-2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="11" />
                                        <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                    </svg>
                                    <p class="ml-4">
                                        Extracting classes with
                                        <code class="text-sm font-bold text-gray-900">@apply</code>
                                    </p>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-6 h-6 flex-none fill-sky-100 stroke-sky-500 stroke-2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="11" />
                                        <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                                    </svg>
                                    <p class="ml-4">Code completion with instant preview</p>
                                </li>
                            </ul>
                            <p>Perfect for learning how the framework works, prototyping a new idea, or creating a demo to share online.</p>
                        </div>
                        <div class="pt-8 text-base leading-7 font-semibold">
                            <p class="text-gray-900">Want to dig deeper into Tailwind?</p>
                            <p>
                                <a href="https://tailwindcss.com/docs" class="text-sky-500 hover:text-sky-600">Read the docs &rarr;</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
