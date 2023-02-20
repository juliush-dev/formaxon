@props(['active', 'as' => 'Link'])
<{{ $as }}
    {{ $attributes->class(['p-3 px-4 hover:bg-sky-500/3 whitespace-nowrap flex flex-nowrap space-x-2', 'text-slate-300' => isset($active) && !$active, 'text-sky-500 font-medium bg-sky-500/5' => $active ?? false]) }}>
    {{ $slot }}
    </{{ $as }}>
