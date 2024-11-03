<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/images/logo_mini.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
        <title>@yield('title') | TaskApp</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        <div>
            <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
                <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

                <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="pt-10 fixed z-30 inset-y-0 left-0 max-w-48 transition duration-300 transform bg-gray-700 border-r-2 border-gray-300 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">

                    <nav class="mt-4 pt-4">

                        <a href="{{ route('admin.tasks.index') }}" 
                            class="flex items-center mt-4 py-2 px-6 hover:text-yellow-500 no-underline
                            {{Route::is('admin.tasks.*') ? ' bg-gray-900 text-yellow-400' : ' text-white '}}">
                            <i class="fa-solid fa-list-check"></i>
                            <span class="mx-3">Задачи</span>
                        </a>

                        <a href="{{ route('admin.users.index') }}" 
                            class="flex items-center mt-4 py-2 px-6 hover:text-yellow-500 no-underline
                            {{Route::is('admin.users.*') ? ' bg-gray-900 text-yellow-400' : ' text-white '}}">
                            <i class="fa-solid fa-users"></i>
                            <span class="mx-3">Пользователи</span>
                        </a>

                    </nav>
                </div>

                <div class="flex-1 flex flex-col overflow-hidden bg-gray-100">
                    <header class="flex justify-between items-center mx-10 py-4 px-6 bg-white border-b-2 shadow-md rounded-xl border-gray-300">
                        <div class="flex items-center">
                            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="flex items-center">
                            <a href="{{ route('admin.logout') }}"
                                class="block px-4 py-2 text-sm text-gray-900 hover:bg-gray-900 hover:text-white">
                                Выйти
                            </a>
                        </div>
                    </header>

                    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>