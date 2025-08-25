<x-layout heading="Ask a Question" bgImage="images/bg-comic-que.png">
    <div class="max-w-3xl mx-auto">
        <div class="p-6 bg-white dark:bg-gray-900 rounded-2xl shadow border border-gray-200 dark:border-gray-800">
            <form method="POST" action="{{ route('questions.store') }}" class="space-y-5">
                @csrf

                <x-input-section label="Title" for="title" error="title">
                    <input id="title" name="title" type="text" value="{{ old('title') }}"
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Write a clear, concise title">
                </x-input-section>

                <x-input-section label="Details" for="body" error="body">
                    <textarea id="body" name="body" rows="10"
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Describe your problem, what you've tried, and what you expect">{{ old('body') }}</textarea>
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
                    <a href="/" class="text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
