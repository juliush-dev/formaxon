@props(['form'])
<div>
    <x-splade-cell name as="$form">
        <span class="flex space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            <Link href="{{ route('forms.show', $form) }}" class="text-blue-600">{{ $form->name }}</Link>
        </span>
    </x-splade-cell>
    <x-splade-cell target as="$form">
        <span>{{ ucfirst(__($form->target)) }}</span>
    </x-splade-cell>
    <x-splade-cell visible_for_target as="$form">
        @if ($form->visible_for_target)
            <span>
                {{ __('Yes') }}
            </span>
        @else
            <span>
                {{ __('No') }}
            </span>
        @endif
    </x-splade-cell>
    <x-splade-cell actions as="$form">
        <div class="flex space-x-4">
            <x-dropdown>
                <x-slot name="trigger">
                    <button type="button"
                        class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                        id="menu-button" aria-expanded="true" aria-haspopup="true">
                        {{ __('Options') }}
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content" class="p">
                    <Link href="{{ route('forms.edit', $form) }}" class="text-gray-700 block px-4 py-2 text-sm">
                    Edit form </Link>
                    <x-splade-data>
                        <x-splade-select v-model="data.field" choices>
                            <option value="" selected>Select one field for more action</option>
                            @foreach (\App\Models\FormField::where('form_id', $form->id)->get() as $formField)
                                <option value="{{ $formField->id }}">{{ $formField->label }}</option>
                            @endforeach
                        </x-splade-select>
                        <Link modal v-if="data.field"
                            v-bind:href="`/forms/{{ $form->id }}/fields/${data.field}/edit`"
                            class="text-gray-700 block px-4 py-2 text-sm">
                        Configuration </Link>
                        <Link confirm v-if="data.field" v-bind:href="`/forms/{{ $form->id }}/fields/${data.field}`"
                            method="DELETE" class="text-gray-700 block px-4 py-2 text-sm">
                        Delete </Link>
                        <button class="rounded-md border px-2 py-4" @click="data.field = ''">Hide actions</button>
                    </x-splade-data>
                    <x-splade-data>
                        <div class="flex flex-col space-y-4">
                            <x-splade-select v-model="data.field_type" label="Add a new field of type" choices>
                                <option value="" selected disabled>Select the type</option>
                                @foreach (\App\Enums\FormFieldType::cases() as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </x-splade-select>
                            <Link modal v-if="data.field_type"
                                v-bind:href="`{{ route('forms.fields.create', $form) }}?field_type=${data.field_type}`"
                                class="w-full border bg-blue-600 text-white font-medium p-2 rounded-md text-center">
                            Add
                            </Link>
                        </div>
                    </x-splade-data>
                    <Link method='DELETE'
                        confirm="{{ __('Deleting this form will delete everything related to it. Continue?') }}"
                        confirm-button="{{ __('Yes') }}" cancel-button="{{ __('No') }}"
                        href="{{ route('forms.destroy', $form) }}" class="text-red-500 block px-4 py-2 text-sm">
                    Delete form </Link>
                </x-slot>
            </x-dropdown>

        </div>
    </x-splade-cell>
    </x-splade-table>
