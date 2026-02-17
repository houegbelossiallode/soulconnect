<nav x-data="{ open: false }" class="fixed top-0 w-full z-50 px-6 py-4">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto glass rounded-2xl px-4 sm:px-6 lg:px-8 shadow-2xl border border-white/10">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="text-xl font-bold tracking-tighter">
                            <span class="text-rose-500">❤️</span> SOUL<span class="text-white/50 lowercase">connect</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white/70 hover:text-white border-rose-500 text-sm">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('discover')" :active="request()->routeIs('discover')" class="text-white/70 hover:text-white border-rose-500 text-sm">
                        {{ __('Discover') }}
                    </x-nav-link>
                    <x-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.index')" class="text-white/70 hover:text-white border-rose-500 text-sm">
                        {{ __('Messages') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Language Switcher -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-white/10 text-sm leading-4 font-medium rounded-full text-white/70 glass hover:text-white hover:bg-white/5 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ strtoupper(App::getLocale()) }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="glass border border-white/10 rounded-xl overflow-hidden shadow-2xl">
                            <x-dropdown-link :href="route('lang.switch', 'fr')" class="text-white/70 hover:bg-white/5 hover:text-white">
                                🇫🇷 Français
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('lang.switch', 'en')" class="text-white/70 hover:bg-white/5 hover:text-white">
                                🇺🇸 English
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('lang.switch', 'es')" class="text-white/70 hover:bg-white/5 hover:text-white">
                                🇪🇸 Español
                            </x-dropdown-link>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-0">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-2 py-1.5 border border-white/10 text-sm leading-4 font-medium rounded-full text-white/70 glass hover:text-white hover:bg-white/5 focus:outline-none transition ease-in-out duration-150 gap-3">
                            <div class="w-8 h-8 rounded-full overflow-hidden border border-white/10 shadow-lg">
                                <img src="{{ Auth::user()->profile_photo_url }}" class="w-full h-full object-cover">
                            </div>
                            <div class="pr-2">{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="glass border border-white/10 rounded-xl overflow-hidden shadow-2xl">
                            <x-dropdown-link :href="route('profile.edit')" class="text-white/70 hover:bg-white/5 hover:text-white">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        class="text-rose-400 hover:bg-rose-500/10"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white/50 hover:text-white hover:bg-white/5 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden mt-2">
        <div class="glass rounded-xl p-2 space-y-1 border border-white/10">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white/70 rounded-lg">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 mt-2 glass rounded-xl border border-white/10">
            <div class="px-4 border-b border-white/5 pb-3 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full overflow-hidden border border-white/10 shadow-lg">
                    <img src="{{ Auth::user()->profile_photo_url }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-white/40">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white/70">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            class="text-rose-400"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
