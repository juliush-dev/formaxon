@props(['active', 'as' => 'Link'])
<{{ $as }}
    {{ $attributes->class(['p-3 border border-slate-100 rounded-lg hover:bg-gray-400 hover:text-white', 'text-gray-500' => isset($active) && !$active, 'text-white bg-gray-500' => $active ?? false]) }}>
    {{ $slot }}
    </{{ $as }}>
