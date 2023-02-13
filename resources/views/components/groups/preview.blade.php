@props(['group'])
@php
    $errorsBagName = \App\Http\Controllers\FormGroupFormController::getRequestErrorsBagName($group);
    $formsNotYetInGroup = \App\Models\Form::get()->diff($group->forms);
@endphp
<div class="flex flex-col space-y-4 p-4 border shadow-sm bg-slate-200 rounded-md">
    <header>
        <h2 class="text-xl">{{ ucfirst(__($group->name)) }}</h2>
    </header>
    <main class="flex flex-col space-y-4">
        @forelse ($group->forms as $form)
            <div class="bg-slate-100 p-4">
                <span>{{ $form->title }}</span>
                <div class="flex space-x-4 justify-end">
                    <Link modal href="{{ route('forms.show', $form) }}">
                    Edit this form
                    </Link>
                    <Link method='DELETE' confirm
                        href="{{ route('groups.forms.destroy', ['group' => $group, 'form' => $form]) }}"
                        class="text-red-500">
                    Delete Form
                    </Link>
                </div>
            </div>
        @empty
            <x-hint text="No form yet. Start adding new ones!" />
        @endforelse
    </main>
    <footer class="flex flex-col space-y-4 border-t border-slate-300 pt-4">
        @if ($formsNotYetInGroup->count() > 0)
            <x-splade-form action="{{ route('groups.forms.store', $group) }}" method="POST" submit-on-change="forms"
                class="shadow-sm p-4 bg-slate-300 rounded-md">
                <x-splade-checkboxes name="forms" option-label="title" option-value="id"
                    label="Forms not yet in this group" :options="$formsNotYetInGroup
                        ->mapWithKeys(fn($item, $key) => [$item['id'] => $item['title']])
                        ->all()" />
                @error('forms', $errorsBagName)
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-splade-form>
        @else
            <x-hint text="This group contains all available forms" />
        @endif
        <div class="flex space-x-4">
            <Link modal href="{{ route('groups.edit', $group) }}">
            Edit group
            </Link>
            <Link method='DELETE'
                confirm="{{ __('Deleting this group will delete everything related to it. Continue?') }}"
                confirm-button="{{ __('Yes') }}" cancel-button="{{ __('No') }}"
                href="{{ route('groups.destroy', $group) }}" class="text-red-500">
            Delete group
            </Link>
        </div>
    </footer>
</div>
