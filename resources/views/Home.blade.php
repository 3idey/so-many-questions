<x-layout heading="Home">

    <h2 class="">All Questions:</h2>
    <ul>
        @foreach ($questions as $question)
            <li>
                <strong>{{ $question->title }}</strong>
                by {{ $question->user->name ?? 'Unknown' }}
                <br>
                Tags:
                @foreach ($question->tags as $tag)
                    <span
                        class="text-blue-500 hover:text-blue-600
                         transition-all duration-500 ease-in-out">{{ $tag->name }}</span>
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </li>
        @endforeach
    </ul>

</x-layout>
