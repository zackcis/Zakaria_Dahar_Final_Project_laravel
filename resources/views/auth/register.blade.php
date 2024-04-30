<!-- component -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="w-full min-h-screen flex items-center justify-center">
        <div class="w-full h-screen flex items-center justify-center">
            <div
                class="w-full sm:w-5/6 md:w-2/3 lg:w-1/2 xl:w-1/3 2xl:w-1/4 h-full bg-white flex items-center justify-center">
                <div class="w-full px-12">

                    <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Sign Up</h2>
                    <p class="text-center text-sm text-gray-600 mt-2">Already have an account? <a href="#"
                            class="text-blue-600 hover:text-blue-700 hover:underline" title="Sign In">Sign in here</a>
                    </p>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Profile picture')" />
                            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" />
                            {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                        </div>
                        {{-- <div>
                            <label for="image">Profile Image</label>
                            <input id="image" type="file" name="image">
                        </div> --}}
                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="flex items-center justify-between">
                        <div class="w-full h-[1px] bg-gray-300"></div>
                        <span class="text-sm uppercase mx-6 text-gray-400">Or</span>
                        <div class="w-full h-[1px] bg-gray-300"></div>
                    </div>

                    <div class="text-sm flex justify-center items-center">
                        <x-primary-button class="ms-3  w-[90%] mt-5">
                            <a
                            href="{{ route('login') }}"
                            class="w-[90%] text-white rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]  dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white "
                        >
                            Login
                        </a>
                        </x-primary-button>
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex lg:w-1/2 xl:w-2/3 2xl:w-3/4 h-full bg-cover"
                style="background-image: url('https://vojislavd.com/ta-template-demo/assets/img/auth-background.jpg');">
                <div class="w-full h-full flex flex-col items-center justify-center bg-black bg-opacity-30">
                    <div class="flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-16 w-16 xl:h-20 xl:w-20 2xl:h-24 2xl:w-24 text-gray-100" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5">
                            </path>
                        </svg>
                        <h1 class="text-3xl xl:text-4xl 2xl:text-5xl font-bold text-gray-100 tracking-wider">Template
                        </h1>
                    </div>
                    <p class="text-gray-300 mt-4 px-16 text-center">Free admin dashboard template created with Tailwind
                        CSS and Alpine.js</p>
                    <a href="#"
                        class="mt-6 bg-gray-100 hover:bg-gray-200 px-6 py-2 rounded text-sm uppercase text-gray-900 transition duration-150"
                        title="Learn More">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
