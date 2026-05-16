        <flux:sidebar sticky collapsible="mobile" class="fixed inset-y-0 left-0 z-50 w-72 border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900
        ">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>
            
            <flux:sidebar.nav>
                {{-- <flux:sidebar.group :heading="__('Platform')" class="grid">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                </flux:sidebar.group> --}}

                {{-- SUPER ADMIN Y ADMINISTRADOR --}}
                @if(auth()->user()
                ->hasAnyRole(['Super Admin','Administrador']))
                    
                @include('layouts.app.navigation.admin')
                @endif
                    {{-- DIRECCION --}}
                @if(auth()->user()
                ->hasAnyRole(['Director','Subdirector']))
                    
                @include('layouts.app.navigation.direccion')
                @endif
                {{-- DOCENTE --}}
                @if(auth()->user()
                ->hasRole(['Docente']))
                    
                @include('layouts.app.navigation.docente')
                @endif
                {{-- TUTOR --}}
                @if(auth()->user()
                ->hasRole(['Tutor']))
                    
                @include('layouts.app.navigation.tutor')
                @endif
            </flux:sidebar.nav>

            <flux:spacer />
            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>
        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />
                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Configuración') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Salir') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>
         {{-- <flux:main class="lg:pl-72">
            <div class="px-6 py-6">
             {{ $slot }} 
             
            </div>
        </flux:main> 
        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts --}}
  

