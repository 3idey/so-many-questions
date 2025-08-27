<x-layout heading="Question Details" bgImage="images/comic-bg-2.png">
    <div class="max-w-4xl mx-auto space-y-8">
        <article class="p-6 bg-white dark:bg-gray-900 rounded-2xl shadow border border-gray-200 dark:border-gray-800">
            <header class="mb-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $question->title }}</h1>
                <div class="mt-2 text-sm text-gray-600 dark:text-gray-300 flex items-center gap-2 flex-wrap">
                    <span>Asked {{ $question->created_at->diffForHumans() }}</span>
                    <span>by {{ $question->user->name ?? 'Unknown' }}</span>
                </div>
                <div>
                    @auth
                        @if ($question->user_id === auth()->user()->id)
                            <form method="POST" action="{{ route('questions.destroy', $question) }}">
                                @csrf
                                @method('DELETE')
                                <div class="">
                                    <button tybe="submit"
                                        class="inline-flex items-center justify-center
                                        gap-2 px-4 py-2 rounded-xl bg-red-600 text-white font-medium shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-60 disabled:cursor-not-allowed">

                                        Delete</button>

                                </div>
                            </form>
                        @endif
                    @endauth
                </div>
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($question->tags as $tag)
                        <a href="{{ route('tags.show', $tag) }}"
                            class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 hover:bg-blue-700 hover:text-white rounded-full">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </header>

            <div class="prose dark:prose-invert max-w-none">
                <p class="whitespace-pre-line text-gray-800 dark:text-gray-200">{{ $question->body }}</p>
            </div>
        </article>

        @auth
            <section class="p-6 bg-white dark:bg-gray-900 rounded-2xl shadow border border-gray-200 dark:border-gray-800">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Your Answer</h2>
                <form method="POST" action="{{ route('answers.store', $question) }}" class="space-y-3">
                    @csrf
                    <x-input-section label="Answer" for="answer_body" error="body">
                        <textarea id="answer_body" name="body" rows="6"
                            class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Write your answer here...">{{ old('body') }}</textarea>
                    </x-input-section>
                    <x-button type="submit">Post Answer</x-button>
                </form>
            </section>
        @endauth

        <section class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-black">Answers ({{ $question->answers->count() }})
            </h2>

            @forelse ($question->answers as $answer)
                <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <span>by {{ $answer->user->name ?? 'Unknown' }}</span>
                                <span>•</span>
                                <span>{{ $answer->created_at->diffForHumans() }}</span>
                                @if ($answer->is_best)
                                    <span class="ml-2 px-2 py-0.5 text-xs rounded bg-green-100 text-green-700">Crazy
                                        Theory</span>
                                @endif
                            </div>
                            <p class="mt-2 text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $answer->body }}
                            </p>
                        </div>
                        <div>
                            @auth
                                @if ($answer->user_id === auth()->user()->id)
                                    <form method="POST" action="{{ route('answers.destroy', $answer) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="">
                                            <button tybe="submit"
                                                class="inline-flex items-center justify-center
                                        gap-2 px-4 py-2 rounded-xl bg-red-600 text-white font-medium shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-60 disabled:cursor-not-allowed">

                                                Delete</button>

                                        </div>
                                    </form>
                                @endif
                            @endauth
                        </div>
                        @auth
                            @if (auth()->id() === $question->user_id && !$answer->is_best)
                                <form method="POST" action="{{ route('answers.best', [$question, $answer]) }}">
                                    @csrf
                                    <x-button type="submit">Mark as Crazy Theory</x-button>
                                </form>
                            @endif
                        @endauth
                    </div>

                    <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Replies
                            ({{ $answer->comments->count() }})
                        </h3>
                        <div class="space-y-3">
                            @foreach ($answer->comments as $comment)
                                <div
                                    class="text-sm p-3 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                                        <span>{{ $comment->user->name ?? 'Unknown' }}</span>
                                        <span>•</span>
                                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="mt-1 text-gray-800 dark:text-gray-200">{{ $comment->body }}</p>
                                </div>
                                @auth
                                    @if ($comment->user_id === auth()->user()->id)
                                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="">
                                                <button tybe="submit"
                                                    class="inline-flex items-center justify-center
                                        gap-2 px-4 py-2 rounded-xl bg-red-600 text-white font-medium shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-60 disabled:cursor-not-allowed">

                                                    Delete</button>

                                            </div>
                                        </form>
                                    @endif
                                @endauth
                            @endforeach
                        </div>


                        @auth
                            <form method="POST" action="{{ route('comments.store', $answer) }}" class="mt-3 space-y-2">
                                @csrf
                                <x-input-section label="Add a reply" for="comment_body_{{ $answer->id }}" error="body">
                                    <textarea id="comment_body_{{ $answer->id }}" name="body" rows="3"
                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Write a reply..."></textarea>
                                </x-input-section>
                                <x-button type="submit">Reply</x-button>
                            </form>
                        @endauth
                    </div>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">No answers yet. Be the first to answer!</p>
            @endforelse
        </section>
    </div>
</x-layout>
