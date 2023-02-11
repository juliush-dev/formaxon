@php
    use App\Models\Role;
@endphp
<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    @php
        $role = Auth::user()->role_id;
        $isAdminOrAssistant = $role == Role::IS_ADMIN || $role == Role::IS_ASSISTANT;
        $isCompany = Auth::user()->role_id == Role::IS_COMPANY;
    @endphp
    @if ($isAdminOrAssistant)
        @include('admin-dashboard')
    @elseif($isCompany)
        @include('company-dashboard')
    @endif
</x-app-layout>
