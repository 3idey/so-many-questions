<x-layout :heading="'Tag: ' . $tag->name" bgImage="images/comic-bg-2.png">
    <div class="mb-6">
        <a href="{{ route('questions.index') }}" class="text-sm text-blue-600 hover:underline">← Back to all questions</a>
    </div>

    <h2 class="font-bold text-xl mb-4 text-gray-900 dark:text-gray-100">Questions tagged "{{ $tag->name }}"</h2>

    @if ($questions->isEmpty())
        <p class="text-gray-600 dark:text-gray-300">No questions found for this tag yet.</p>
    @else
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
                                        class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900 hover:bg-blue-700 hover:text-white dark:text-blue-200 rounded-full">
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
    @endif
</x-layout>
