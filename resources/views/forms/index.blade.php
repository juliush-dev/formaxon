<x-app-layout>
    <x-slot name="header">
        <span class="flex space-x-3 justify-between">
            <Link modal href="{{ route('forms.create') }}" class="border rounded px-4 py-1 shadow-sm">
            {{ __('New form') }}
            </Link>
        </span>
    </x-slot>
    <div class="flex flex-col space-y-5 p-5">
        @foreach (\App\Models\Form::get() as $form)
            <x-forms.preview :$form />
        @endforeach
    </div>
</x-app-layout>
