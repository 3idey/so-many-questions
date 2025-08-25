<x-layout heading="Create an account" bgImage="images/comic-bg.jpg">
    <div class="min-h-[80vh] flex items-center justify-center p-4">
        <div class="w-full max-w-md mx-auto bg-white/95 backdrop-blur shadow-lg rounded-2xl p-6">
            @if ($errors->any())
                <div class="mb-4 rounded border border-red-300 bg-red-50 text-red-700 p-3 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" />
                </div>

                <div class="flex items-center justify-between pt-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-md bg-black px-4 py-2 text-white hover:bg-black/80 transition-colors">
                        Create account
                    </button>
                    <a href="{{ route('login') }}" class="text-sm underline text-gray-600 hover:text-gray-900">Already
                        have an account?</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
