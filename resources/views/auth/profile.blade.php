<x-layout heading="Your Profile">
    <div class="max-w-2xl mx-auto grid gap-8 md:grid-cols-3">
        <div class="md:col-span-2 bg-white shadow rounded-lg p-6">
            @if (session('success'))
                <div class="mb-4 rounded border border-green-300 bg-green-50 text-green-700 p-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded border border-red-300 bg-red-50 text-red-700 p-3 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input id="password" name="password" type="password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" />
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black" />
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-md bg-black px-4 py-2 text-white hover:bg-black/80 transition-colors">
                        Save changes
                    </button>
                </div>
            </form>
        </div>

        <div class="md:col-span-1 bg-white shadow rounded-lg p-6 h-fit">
            <h3 class="text-sm font-semibold text-gray-800 mb-3">Danger zone</h3>
            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Delete your account? This cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700 transition-colors">
                    Delete account
                </button>
            </form>
        </div>
    </div>
</x-layout>
