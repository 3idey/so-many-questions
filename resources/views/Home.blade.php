<x-layout heading="Home" bgImage="images/comic-bg.jpg">

    @auth
        <div class="mb-8 p-6 bg-white dark:bg-gray-900 rounded-2xl shadow border border-gray-200 dark:border-gray-800">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Ask a question</h2>
            <form method="POST" action="{{ route('questions.store') }}" class="space-y-4">
                @csrf

                <x-input-section label="Title" for="title" error="title">
                    <input id="title" name="title" type="text" value="{{ old('title') }}"
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="What is your question?">
                </x-input-section>

                <x-input-section label="Details" for="body" error="body">
                    <textarea id="body" name="body" rows="6"
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Provide more context, what you tried, and what you expect...">{{ old('body') }}</textarea>
                </x-input-section>

                <x-input-section label="Tags" for="tags" error="tags">
                    <div class="flex flex-wrap gap-2">
                        @foreach ($tags as $tag)
                            <label
                                class="inline-flex items-center gap-2 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full cursor-pointer select-none">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded"
                                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                <span
                                    class="text-xs font-medium text-gray-700 dark:text-gray-200">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </x-input-section>

                <div class="flex items-center gap-3">
                    <x-button type="submit">Post Question</x-button>
                    <a href="{{ route('questions.create') }}"
                        class="text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600">Open full form</a>
                </div>
            </form>
        </div>
    @else
        <div class="mb-8 p-6 bg-white dark:bg-gray-900 rounded-2xl shadow border border-gray-200 dark:border-gray-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Want to ask a question?</h2>
            <p class="text-gray-600 dark:text-gray-300">Please <a href="{{ route('login') }}"
                    class="text-blue-600 hover:underline">log in</a> or <a href="{{ route('register') }}"
                    class="text-blue-600 hover:underline">create an account</a> to post.</p>
        </div>
    @endauth

    <h2 class="font-bold text-2xl text-center mb-6 text-gray-900 ">Recent Questions</h2>

    <ul class="space-y-4">
        @foreach ($questions as $question)
            <li
                class="p-5 bg-white dark:bg-gray-800 shadow-md rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-all duration-300">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('questions.show', $question) }}"
                            class="text-lg font-semibold text-gray-900 dark:text-gray-100 hover:text-blue-600">
                            {{ $question->title }}
                        </a>
                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                            {{ \Illuminate\Support\Str::limit($question->body, 160) }}
                        </p>
                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            @foreach ($question->tags as $tag)
                                <a href="{{ route('tags.show', $tag) }}"
                                    class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700
                                     dark:bg-blue-900 hover:bg-blue-700 hover:text-white dark:text-blue-200 rounded-full">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-col items-end text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                        <span>{{ $question->created_at->diffForHumans() }}</span>
                        <span class="mt-1">{{ $question->answers_count ?? 0 }}
                            answer{{ ($question->answers_count ?? 0) === 1 ? '' : 's' }}</span>
                        <span class="mt-1">by {{ $question->user->name ?? 'Unknown' }}</span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="mt-6 flex justify-center">
        {{ $questions->links('pagination::tailwind') }}
    </div>

</x-layout>
