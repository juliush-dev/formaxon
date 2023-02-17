<x-app-layout>
    <x-slot name="header">
        <span class="flex space-x-3 justify-between">
            <h1 class="text-2xl">Groups</h1>
            <Link modal href="{{ route('groups.create') }}" class="border rounded-md px-4 py-2">
            {{ __('New Group') }}
            </Link>
        </span>
    </x-slot>
    <div class="flex flex-col space-y-5 mt-4">
        @foreach (\App\Models\FormGroup::get() as $group)
            <x-groups.preview :$group />
        @endforeach
    </div>
</x-app-layout>
