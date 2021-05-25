<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PCP</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{asset('js/app.js')}}" defer></script>
         
<style>
    li>ul                 { transform: translatex(100%) scale(0) }
    li:hover>ul           { transform: translatex(101%) scale(1) }
    li > button svg       { transform: rotate(-90deg) }
    li:hover > button svg { transform: rotate(-270deg) }
    .group:hover .group-hover\:scale-100 { transform: scale(1) }
    .group:hover .group-hover\:-rotate-180 { transform: rotate(180deg) }
    .scale-0 { transform: scale(0) }
    .min-w-32 { min-width: 8rem }
  </style>
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    </head>
<body class="bg-gray-200">
    <div>
        <nav class="bg-gray-800">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <img class="h-8 w-8" src="{{url('/images/logo.png')}}" alt="PCP">
                </div>
                <div class="hidden md:block">
                  <div class="ml-10 flex items-baseline space-x-4">
                    <a href="{{ route('home') }}" class="{{ 'home' == request()->is('home*') ? 'bg-gray-900 text-white px-3 ' : 'text-gray-300 hover:bg-gray-700 hover:text-white ' }} px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    
                    <a href="{{ route('competitions-show') }}" class="{{ 'competitions' == request()->is('competitions*') ? 'bg-gray-900 text-white px-3 ' : 'text-gray-300 hover:bg-gray-700 hover:text-white ' }} px-3 py-2 rounded-md text-sm font-medium">Competitions</a>
      
                    <a href="{{ route('about') }}" class="{{ 'about' == request()->is('about') ? 'bg-gray-900 text-white px-3 ' : 'text-gray-300 hover:bg-gray-700 hover:text-white ' }} px-3 py-2 rounded-md text-sm font-medium">About PCP</a>
                  </div>
                </div>
              </div>
              <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    @guest
                    <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @endguest
                    @auth
                    <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                      <span class="sr-only">View notifications</span>
                      <!-- Heroicon name: outline/bell -->
                      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                      </svg>
                    </button>
                    
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                      <div class="group inline-block">
                        <button class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-haspopup="true">
                          <span class="sr-only">Open user menu</span>
                          <img class="h-8 w-8 rounded-full" src="{{url('/images/avatar') .'/'. auth()->user()->avatar }}" alt="">
                        </button>
                        <ul class="bg-white dark:bg-gray-600 border rounded-sm transform scale-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top min-w-32">
                          <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><a href="{{route('Profile-show', ['username' => auth()->user()->username ])}}" >My Profile</a></li>
                          @if (Gate::allows('show'))
                          <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><a href="{{ route('controlpanel') }}" >Control Panel</a></li>
                          @endif
                          <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><a href="{{ route('logout') }}" >Sign out</a></li>
                        </ul>
                      </div>
                    </div>
                    @endauth
                </div>
              </div>
            </div>
        </div>
         
</div>
@yield('content')
       
</body>
</html>