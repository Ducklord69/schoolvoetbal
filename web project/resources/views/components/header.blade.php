<nav x-data="{ open: false }" class="bg-red-500 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('index') }}" class="shrink-0">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-300" />
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:ms-10 sm:flex">
                    @if(Auth::check())
                        @if(Auth::user()->role === 'coach')
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('tournaments.index')" :active="request()->routeIs('tournaments.index')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                                {{ __('Tournaments') }}
                            </x-nav-link>
                        @endif
                    @endif
                    @if(Auth::check())
                        @if(Auth::user()->role === 'referee')
                            <x-nav-link :href="route('referee.dashboard')" :active="request()->routeIs('referee.dashboard')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                                {{ __('Tournaments') }}
                            </x-nav-link>
                        @endif
                    @endif
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('tournaments.index')" :active="request()->routeIs('tournaments.index')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                            {{ __('Tournaments') }}
                        </x-nav-link>
                        <x-nav-link :href="route('tournaments.create')" :active="request()->routeIs('tournaments.create')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                            {{ __('Create Tournament') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-900 hover:text-blue-500 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</div>
                            <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::check())
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Logout Form -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <x-dropdown-link :href="route('login')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                                {{ __('Login') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                                {{ __('Register') }}
                            </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-600 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 transition ease-in-out duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        @if(Auth::check())
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-300">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-600 dark:text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-300">Guest</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="text-gray-800 dark:text-gray-200 hover:text-blue-500 dark:hover:text-gray-400">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endif
    </div>
</nav>
