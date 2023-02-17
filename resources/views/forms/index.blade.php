<x-app-layout>
    <x-slot name="header">
        <span class="flex space-x-3 justify-between">
            <h1 class="text-2xl">{{ __('Forms') }}</h1>
            <Link modal href="{{ route('forms.create') }}" class="border rounded-md px-4 py-2">
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
