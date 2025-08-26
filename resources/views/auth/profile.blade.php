<x-layout heading="Your Profile" bgImage="images/comic-lightning.jpg">
    <!-- Profile header card -->
    <div class="w-full max-w-4xl mx-auto mb-8">
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 ring-1 ring-black/10 shadow-xl">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 rounded-full bg-white/20 flex items-center justify-center text-xl font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-2xl font-semibold">{{ auth()->user()->name }}</h1>
                        <p class="text-white/80 text-sm">{{ auth()->user()->email }}</p>
                        <p class="text-white/70 text-xs mt-1">Member since
                            {{ auth()->user()->created_at->format('M Y') }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 divide-x divide-white/20 rounded-xl bg-white/10 backdrop-blur">
                    <div class="px-4 py-2 text-center">
                        <div class="text-xl font-semibold">{{ $questionCount ?? 0 }}</div>
                        <div class="text-xs uppercase tracking-wide text-white/80">Questions</div>
                    </div>
                    <div class="px-4 py-2 text-center">
                        <div class="text-xl font-semibold">{{ $answerCount ?? 0 }}</div>
                        <div class="text-xs uppercase tracking-wide text-white/80">Answers</div>
                    </div>
                    <div class="px-4 py-2 text-center">
                        <div class="text-xl font-semibold">{{ $commentCount ?? 0 }}</div>
                        <div class="text-xs uppercase tracking-wide text-white/80">Comments</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings and danger zone -->
    <div class="min-h-[50vh] flex items-center justify-center">
        <div class="w-full max-w-2xl grid gap-8 md:grid-cols-3">
            <div
                class="md:col-span-2 bg-white/95 dark:bg-gray-900/80 backdrop-blur ring-1 ring-black/5 dark:ring-white/10 shadow-lg rounded-2xl p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Profile settings</h2>
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
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input id="name" name="name" type="text"
                            value="{{ old('name', auth()->user()->name) }}" required
                            class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-600 focus:ring-blue-600" />
                    </div>

                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input id="email" name="email" type="email"
                            value="{{ old('email', auth()->user()->email) }}" required
                            class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-600 focus:ring-blue-600" />
                    </div>

                    <div>
                        <label for="current_password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current
                            Password</label>
                        <input id="current_password" name="current_password" type="password" required
                            class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-600 focus:ring-blue-600" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New
                                Password</label>
                            <input id="password" name="password" type="password"
                                class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-600 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm
                                Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-600 focus:ring-blue-600" />
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 transition-colors shadow-sm">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>

            <div
                class="md:col-span-1 bg-white/95 dark:bg-gray-900/80 backdrop-blur ring-1 ring-black/5 dark:ring-white/10 shadow-lg rounded-2xl p-6 h-fit">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3">Danger zone</h3>
                <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-3">
                    @csrf
                    @method('DELETE')
                    <div>
                        <label for="delete_current_password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current
                            Password</label>
                        <input id="delete_current_password" name="current_password" type="password" required
                            class="mt-1 block w-full rounded-xl border-gray-300 dark:border-red-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-red-600 focus:ring-red-600" />
                    </div>
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center rounded-xl bg-red-600 px-4 py-2 text-white hover:bg-red-700 transition-colors shadow-sm"
                        onclick="return confirm('Delete your account? This cannot be undone.')">
                        Delete account
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Activity sections -->
    <div class="w-full max-w-4xl mx-auto grid gap-6 md:grid-cols-3">
        <div
            class="md:col-span-2 bg-white/95 dark:bg-gray-900/80 backdrop-blur ring-1 ring-black/5 dark:ring-white/10 shadow-lg rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Your Questions</h3>
            @if (isset($questions) && $questions->count())
                <ul class="space-y-4">
                    @foreach ($questions as $q)
                        <li class="p-4 bg-white dark:bg-gray-800 rounded-xl ring-1 ring-black/5 dark:ring-white/10">
                            <a href="{{ route('questions.show', $q) }}"
                                class="font-medium text-blue-700 dark:text-blue-400 hover:underline">{{ $q->title }}</a>
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach ($q->tags as $t)
                                    <a href="{{ route('tags.show', $t) }}"
                                        class="px-2 py-0.5 text-xs bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200 rounded-full">{{ $t->name }}</a>
                                @endforeach
                            </div>
                            <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ $q->created_at->diffForHumans() }} • {{ $q->answers_count }} answers</div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4">
                    {{ $questions->appends(request()->except('questions_page'))->links('pagination::tailwind') }}</div>
            @else
                <p class="text-sm text-gray-600 dark:text-gray-400">No questions yet.</p>
            @endif
        </div>

        <div
            class="bg-white/95 dark:bg-gray-900/80 backdrop-blur ring-1 ring-black/5 dark:ring-white/10 shadow-lg rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Your Answers</h3>
            @if (isset($answers) && $answers->count())
                <ul class="space-y-4">
                    @foreach ($answers as $a)
                        <li class="p-4 bg-white dark:bg-gray-800 rounded-xl ring-1 ring-black/5 dark:ring-white/10">
                            <div class="text-sm text-gray-700 dark:text-gray-200">
                                {{ \Illuminate\Support\Str::limit($a->body, 140) }}</div>
                            <a href="{{ route('questions.show', $a->question) }}"
                                class="text-xs text-blue-600 dark:text-blue-400 hover:underline">View question:
                                {{ $a->question->title }}</a>
                            <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ $a->created_at->diffForHumans() }} @if ($a->is_best)
                                    <span
                                        class="ml-1 px-1.5 py-0.5 rounded bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-200">Crazy
                                        Theory</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4">
                    {{ $answers->appends(request()->except('answers_page'))->links('pagination::tailwind') }}</div>
            @else
                <p class="text-sm text-gray-600 dark:text-gray-400">No answers yet.</p>
            @endif
        </div>
    </div>

    <div
        class="w-full max-w-4xl mx-auto mt-6 bg-white/95 dark:bg-gray-900/80 backdrop-blur ring-1 ring-black/5 dark:ring-white/10 shadow-lg rounded-2xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Your Comments</h3>
        @if (isset($comments) && $comments->count())
            <ul class="space-y-4">
                @foreach ($comments as $c)
                    <li class="p-4 bg-white dark:bg-gray-800 rounded-xl ring-1 ring-black/5 dark:ring-white/10">
                        <div class="text-sm text-gray-700 dark:text-gray-200">
                            {{ \Illuminate\Support\Str::limit($c->body, 160) }}</div>
                        @if ($c->answer && $c->answer->question)
                            <a href="{{ route('questions.show', $c->answer->question) }}"
                                class="text-xs text-blue-600 dark:text-blue-400 hover:underline">On question:
                                {{ $c->answer->question->title }}</a>
                        @endif
                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            {{ $c->created_at->diffForHumans() }}</div>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4">
                {{ $comments->appends(request()->except('comments_page'))->links('pagination::tailwind') }}</div>
        @else
            <p class="text-sm text-gray-600 dark:text-gray-400">No comments yet.</p>
        @endif
    </div>
</x-layout>
