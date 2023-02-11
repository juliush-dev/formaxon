<nav class="flex flex-nowrap items-center justify-between p-6 bg-slate-100">
    <div class="flex items-center flex-none">
        <span class="font-semibold text-xl tracking-tight">E.A</span>
    </div>
    <x-splade-toggle class="relative flex-1 flex">
        <x-splade-transition
            class="absolute top-20 z-50 w-11/12 mx-auto bg-white shadow-lg rounded-md p-6 flex flex-col space-y-4"
            show="toggled">
            <x-nav-link href="{{ route('welcome') }}" :active="Route::is('welcome')">
                {{ __('Home') }}
            </x-nav-link>
            @if (Auth::guest())
                <x-nav-link href="{{ route('events.index') }}" :active="Route::is('events.index')">
                    {{ __('Events') }}
                </x-nav-link>
                <x-nav-link href="{{ route('login') }}" :active="Route::is('login')">
                    {{ __('Login') }}
                </x-nav-link>
                <x-nav-link href="{{ route('register') }}" :active="Route::is('register')">
                    {{ __('Register') }}
                </x-nav-link>
            @else
                <hr class="md:hidden">
                <x-nav-link href="{{ route('dashboard') }}" :active="Route::is('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link href="{{ route('events.index') }}" :active="Route::is('events.index')">
                    {{ __('Events') }}
                </x-nav-link>
                @can('if_admin')
                    <x-nav-link :href="route('forms.index')" :active="Route::is('forms.index')">
                        {{ __('Forms') }}
                    </x-nav-link>
                    <x-nav-link :href="route('groups.index')" :active="Route::is('groups.index')">
                        {{ __('Form Groups') }}
                    </x-nav-link>
                @endcan
                <hr class="md:hidden">
                <x-nav-link href="{{ route('profile.edit') }}" :active="Route::is('profile.edit')">
                    {{ __('Profile') }}
                </x-nav-link>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type='submit'
                        class="block w-full p-3 text-sm text-right underline decoration-sky-500 underline-offset-8">
                        {{ __('Logout') }}
                    </button>
                </form>
            @endif
        </x-splade-transition>
        <div class="block ml-auto">
            <button
                class="flex items-center px-3 py-2 border rounded border-slate-400 hover:text-slate-500 hover:border-slate-500"
                @click.prevent="toggle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="fill-current w-6 h-6" v-show="!toggled">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 4.5h14.25M3 9h9.75M3 13.5h5.25m5.25-.75L17.25 9m0 0L21 12.75M17.25 9v12" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6" v-show="toggled">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25" />
                </svg>
            </button>
        </div>
    </x-splade-toggle>
</nav>
