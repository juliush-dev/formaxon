<x-app-layout>
    <x-slot name="header">
        <span class="flex space-x-3 justify-between">
            <Link modal href="{{ route('groups.create') }}" class="border rounded px-4 py-1 shadow-sm">
            {{ __('New package') }}
            </Link>
        </span>
    </x-slot>
    <div class="flex flex-col space-y-5 mt-4">
        @foreach (\App\Models\FormGroup::get() as $group)
            <x-groups.preview :$group />
        @endforeach
    </div>
</x-app-layout>
