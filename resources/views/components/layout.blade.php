@props(['heading', 'bgImage' => null])
<x-header title="{{ $heading }}"></x-header>

<body class="text-black font-sans antialiased {{ $bgImage ? '' : 'bg-gray-300' }}" @if($bgImage) style="background-image: url('{{ asset($bgImage) }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;" @endif>

    <nav class="bg-gray-200/90 backdrop-blur text-black p-4">
        <div class="container mx-auto justify-between flex items-center">
            <div>
                <a href="/">

                    <img src={{ \Illuminate\Support\Facades\Vite::asset('resources/images/logo.png') }} alt="logo"
                        class="w-16 h-16 object-contain
                     mr-22 hover:scale-105 transition-transform duration-300 ease-in-out">

                </a>
            </div>


            <ul class="flex space-x-6">
                <li><x-link link="/">Home</x-link>
                </li>
                <li><x-link link="#">Questions</x-link>
                </li>
                <li><x-link link="/about">About</x-link>
                </li>

            </ul>
            @guest
                <div class="flex items-center space-x-4 ml-4">
                    <a href="/login"
                        class="bg-black text-white px-4 py-2 rounded  hover:text-blue-300 transition-colors duration-400 ease-in-out">Login</a>
                    <a href="/register"
                        class="bg-black text-white px-4 py-2 rounded  hover:text-blue-300 transition-colors duration-400 ease-in-out">Register</a>
                </div>
            @endguest
            @auth
                <div class="flex items-center space-x-4 ml-4">
                    <a href="{{ route('profile.show') }}"
                        class="bg-black text-white px-4 py-2 rounded hover:text-blue-300 transition-colors duration-400 ease-in-out">Profile</a>
                    <form method="POST" action="/logout">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-700 text-white px-4 py-2 rounded hover:text-blue-300 transition-colors duration-400 ease-in-out">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>
    <div class="container mx-auto mt-8">
        {{ $slot }}
    </div>

</body>

<x-footer />
