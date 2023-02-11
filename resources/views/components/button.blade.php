@props(['isSubmitter' => false])
<button
    {{ $attributes->class([
        'text-white',
        'border rounded-md block px-4 py-2 text-sm',
        'bg-slate-900' => $isSubmitter,
        'bg-slate-800' => !$isSubmitter,
    ]) }}>
    {{ $slot }}
</button>
