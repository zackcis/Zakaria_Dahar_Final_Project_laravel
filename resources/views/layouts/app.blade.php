<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />

    <title>Zentasks</title>
    <!-- Fonts -->
    <link rel="icon" 
    type="image/png" 
    href="https://icons.veryicon.com/png/o/miscellaneous/itsm-management/task-management-8.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar@latest/main.min.css' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script> --}}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex">
            <aside
                class=" max-[430px]:hidden flex flex-col w-80 min-h-screen px-4 py-8 overflow-y-auto  bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">
                <a href="#" class="mx-auto">
                    <img class="w-auto h-6 sm:h-7" src="{{ asset('images/Capture_décran_2024-04-24_120041.png') }}"
                        alt="">
                </a>
                <div class="flex flex-col items-center mt-6 -mx-2">
                    <img width="" class="object-cover w-24 h-24 mx-2 rounded-full"
                        src={{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/150' }}
                        alt="avatar">
                    <h4 class="mx-2 mt-2 font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</h4>
                    <p class="mx-2 mt-1 text-sm font-medium text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}
                    </p>
                </div>
                <div class="flex flex-col justify-between flex-1 mt-6">
                    <nav>
                        <a class="text-decoration-none flex items-center px-4 py-2 text-gray-700  rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-200"
                            href="{{ route('dashboard') }}">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            <span class="mx-4 font-medium">Dashboard</span>
                        </a>


                        <a class="text-decoration-none flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                            href="{{ route('tasks.index') }}">
                            <i class="fa-solid fa-diagram-project"></i>

                            <span class="mx-4 font-medium">Tasks</span>
                        </a>

                        <a class="text-decoration-none flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                            href="{{ route('projects.index') }}">
                            <i class="fa-solid fa-list-check"></i>

                            <span class="mx-4 font-medium">Projects</span>
                        </a>
                        <a class="text-decoration-none flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                            href="{{ route('calendar.index') }}">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span class="mx-4 font-medium">Calendar</span>
                        </a>
                        <a class="text-decoration-none flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                        href="{{ route('chatify') }}">
                        <i class="fa-regular fa-comment-dots"></i>
                        <span class="mx-4 font-medium">Chat</span>
                    </a>
                        <a class="text-decoration-none flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                            href="{{ route('profile.edit') }}">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.3246 4.31731C10.751 2.5609 13.249 2.5609 13.6754 4.31731C13.9508 5.45193 15.2507 5.99038 16.2478 5.38285C17.7913 4.44239 19.5576 6.2087 18.6172 7.75218C18.0096 8.74925 18.5481 10.0492 19.6827 10.3246C21.4391 10.751 21.4391 13.249 19.6827 13.6754C18.5481 13.9508 18.0096 15.2507 18.6172 16.2478C19.5576 17.7913 17.7913 19.5576 16.2478 18.6172C15.2507 18.0096 13.9508 18.5481 13.6754 19.6827C13.249 21.4391 10.751 21.4391 10.3246 19.6827C10.0492 18.5481 8.74926 18.0096 7.75219 18.6172C6.2087 19.5576 4.44239 17.7913 5.38285 16.2478C5.99038 15.2507 5.45193 13.9508 4.31731 13.6754C2.5609 13.249 2.5609 10.751 4.31731 10.3246C5.45193 10.0492 5.99037 8.74926 5.38285 7.75218C4.44239 6.2087 6.2087 4.44239 7.75219 5.38285C8.74926 5.99037 10.0492 5.45193 10.3246 4.31731Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            <span class="mx-4 font-medium">Settings</span>
                        </a>
                        <div class="sm:flex sm:items-center ">
                            <x-primary-button class="ms-3  w-full mt-5">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link class="text-decoration-none text-white hover:bg-[#374151] w-full p-0 m-0" :href="route('logout')"
                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        Log out
                                    </x-dropdown-link>
                                </form>
                            </x-primary-button>
                        </div>
                    </nav>
                </div>
            </aside>
            {{ $slot }}

        </main>
    </div>
</body>

</html>
