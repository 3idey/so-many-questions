@props([
    'label' => null,
    'for' => null,
    'error' => null,
])

<div class="space-y-1">
    @if ($label)
        <label for="{{ $for }}"
            class="block text-sm font-medium text-gray-800 dark:text-gray-200">{{ $label }}</label>
    @endif

    {{ $slot }}

    @if ($error)
        @error($error)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    @endif
</div>
