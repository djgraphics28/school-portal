<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')" class="grid">
                <flux:navlist.item icon="home-modern" :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navlist.item>

                @can('users.view')
                <flux:navlist.group :heading="__('User Management')" class="grid">
                    <flux:navlist.item icon="user-group" :href="route('users')" :current="request()->routeIs('users')" wire:navigate>
                        {{ __('Users') }}
                    </flux:navlist.item>
                    @can('roles.view')
                    <flux:navlist.item icon="shield-check" :href="route('roles')" :current="request()->routeIs('roles')" wire:navigate>
                        {{ __('Roles') }}
                    </flux:navlist.item>
                    @endcan
                </flux:navlist.group>
                @endcan

                {{-- <flux:navlist.group :heading="__('Academics')" class="grid">
                    <flux:navlist.item icon="academic-cap" wire:navigate>
                        {{ __('Online Grading System') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="clipboard-document-list" wire:navigate>
                        {{ __('Student Information System') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="document-text" wire:navigate>
                        {{ __('Academic Record Management') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="clipboard-document-check" wire:navigate>
                        {{ __('Faculty Evaluation') }}
                    </flux:navlist.item>
                </flux:navlist.group>

                <flux:navlist.group :heading="__('Finance & Fees')" class="grid">
                    <flux:navlist.item icon="banknotes" wire:navigate>
                        {{ __('Fees & Finance') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="credit-card" wire:navigate>
                        {{ __('Online Payments') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="document-chart-bar" wire:navigate>
                        {{ __('Financial Reports') }}
                    </flux:navlist.item>
                </flux:navlist.group>

                <flux:navlist.group :heading="__('School Setup')" class="grid">
                    <flux:navlist.item icon="building-office" wire:navigate>
                        {{ __('School Setup') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="calendar-days" wire:navigate>
                        {{ __('Academic Year & Semesters') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="book-open" wire:navigate>
                        {{ __('Course & Curriculum') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="map" wire:navigate>
                        {{ __('Building & Room Management') }}
                    </flux:navlist.item>
                </flux:navlist.group> --}}

                {{-- <flux:navlist.item icon="speaker-wave" wire:navigate>
                    {{ __('Content Management') }}
                </flux:navlist.item>

                <flux:navlist.item icon="cog-6-tooth" wire:navigate>
                    {{ __('Settings') }}
                </flux:navlist.item> --}}
            </flux:navlist.group>
        </flux:navlist>


        <flux:spacer />

        {{-- <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist> --}}

        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()-> initials()"
                icon-trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>{{ __('Account Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
