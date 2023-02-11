 <x-slot name="header">
     <Link href="{{ route('forms.index') }}" class="text-blue-500">{{ __('Forms') }}</Link>
     <span>{{ ' > ' }}</span>
     <span class="text-gray-800">{{ $form->title }}</span>
 </x-slot>
