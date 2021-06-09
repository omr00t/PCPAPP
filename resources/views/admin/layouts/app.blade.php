<!DOCTYPE html>
<html lang="en" x-data="data()">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PCP</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-bluegray-800">
        <div class="flex h-screen" :class="{ 'overflow-hidden': isSideMenuOpen }">

            <!-- Desktop sidebar -->
            <aside class="z-20 flex-shrink-0 hidden pl-2 overflow-y-auto bg-bluegray-800 w-60 lg:block">
                @include('admin.layouts.menu')
            </aside>

            <!-- Mobile sidebar -->
            <!-- Backdrop -->
            <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 md:items-center md:justify-center"></div>

            <aside
                class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-bluegray-800 dark:bg-bluegray-800 lg:hidden"
                x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
                x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
                @keydown.escape="closeSideMenu">
                @include('admin.layouts.menu')

            </aside>

            <div class="flex flex-col flex-1 w-full overflow-y-auto">
                <header class="z-40 py-4 bg-bluegray-800 ">
                    <div class="flex items-center justify-between h-8 px-6 mx-auto">
                        <!-- Mobile hamburger -->
                        <button class="p-1 mr-5 -ml-1 rounded-md lg:hidden focus:outline-none focus:shadow-outline-purple"
                            @click="toggleSideMenu" aria-label="Menu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </button>
                    </div>
                </header>
                <main class="flex flex-col m-1 border-4 border-green-400 bg-blue-50 rounded-3xl md:m-3">
                    <div style="min-height: 89vh; width: 100%">
                        <div class="flex flex-col items-center w-full p-4 md:p-6">
                            @yield('content')
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script>
            function data() {
                return {
                    isSideMenuOpen: false,
                    toggleSideMenu() {
                        this.isSideMenuOpen = !this.isSideMenuOpen
                    },
                    closeSideMenu() {
                        this.isSideMenuOpen = false
                    },
                }
            }
        </script>
    </body>
</html>
