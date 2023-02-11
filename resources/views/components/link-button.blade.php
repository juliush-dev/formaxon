@props(['forDestruction' => false])
<Link
    {{ $attributes->class([
        'text-white',
        'border rounded-md block px-4 py-2 text-sm',
        'bg-red-500' => $forDestruction,
        'bg-slate-800' => !$forDestruction,
    ]) }}>
{{ $slot }}
</Link>
