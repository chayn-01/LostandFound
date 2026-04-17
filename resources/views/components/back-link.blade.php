@props([
    'href',
    'label' => 'Back',
])

<a
    href="{{ $href }}"
    class="inline-flex items-center gap-2 text-sm font-medium transition"
    style="color: var(--any-primary);"
>
    <span aria-hidden="true">←</span>
    <span>{{ $label }}</span>
</a>
