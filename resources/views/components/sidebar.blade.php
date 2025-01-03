<aside data-sidebar="sidebar" id="drawer-navigation"
    class="fixed top-0 left-0 z-40 w-64 h-dvh transition-transform duration-300 -translate-x-full sm:translate-x-0 font-text dark:bg-gray-800 bg-sidebar-background flex gap-2 flex-col border-r border-sidebar-border"
    tabindex="-1" aria-labelledby="drawer-navigation-label">

    <div data-sidebar="header" class="flex flex-col gap-2 p-4 pb-0">
        <a href="#"
            class="peer/menu-button flex w-full px-2 items-center gap-2 overflow-hidden rounded-md text-left outline-none ring-sidebar-ring transition-[width,height,padding] focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-[[data-sidebar=menu-action]]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground data-[state=open]:hover:bg-sidebar-accent data-[state=open]:hover:text-sidebar-accent-foreground group-data-[collapsible=icon]:!size-8 [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0 hover:bg-sidebar-accent hover:text-sidebar-accent-foreground h-12 text-sm group-data-[collapsible=icon]:!p-0">
            <div
                class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground">
                <img src="{{ asset('img/airport.png') }}" alt="Logo" {{ $attributes }}>

            </div>
            <div class="grid flex-1 text-left text-sm leading-tight">
                <span class="truncate font-semibold">{{ env('APP_NAME', 'Laravel') }}</span>
                <span class="truncate text-xs">Dashboard</span>
            </div>
        </a>
    </div>

    </button>
    <div data-sidebar="content" class="overflow-y-scroll scroll pl-4 pr-2 flex min-h-0 flex-1">
        <div data-sidebar="group" class="flex gap-2 flex-col mt-2 w-full">
            <div data-sidebar="group-label" class="text-xs font-medium text-sidebar-foreground shrink-0 ms-2">
                Menu</div>
            <ul data-sidebar="menu" class="space-y-2 text-sm">
                <li data-sidebar="menu-item">
                    <a href="{{ route('dashboard') }}" data-sidebar="menu-button"
                        class="{{ request()->is('dashboard*') ? 'bg-sidebar-accent dark:bg-gray-700 font-medium' : '' }} transition-colors flex items-center p-2 text-sidebar-accent-foreground rounded-lg dark:text-white hover:bg-sidebar-accent dark:hover:bg-gray-700 group">
                        <div class="flex  items-center justify-center text-sidebar-foreground">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                xmlns="http://www.w3.org/2000/svg" class="size-5">
                                <path
                                    d='M3 6.75c0-1.768 0-2.652.55-3.2C4.097 3 4.981 3 6.75 3s2.652 0 3.2.55c.55.548.55 1.432.55 3.2s0 2.652-.55 3.2c-.548.55-1.432.55-3.2.55s-2.652 0-3.2-.55C3 9.403 3 8.519 3 6.75m0 10.507c0-1.768 0-2.652.55-3.2.548-.55 1.432-.55 3.2-.55s2.652 0 3.2.55c.55.548.55 1.432.55 3.2s0 2.652-.55 3.2c-.548.55-1.432.55-3.2.55s-2.652 0-3.2-.55C3 19.91 3 19.026 3 17.258M13.5 6.75c0-1.768 0-2.652.55-3.2.548-.55 1.432-.55 3.2-.55s2.652 0 3.2.55c.55.548.55 1.432.55 3.2s0 2.652-.55 3.2c-.548.55-1.432.55-3.2.55s-2.652 0-3.2-.55c-.55-.548-.55-1.432-.55-3.2m0 10.507c0-1.768 0-2.652.55-3.2.548-.55 1.432-.55 3.2-.55s2.652 0 3.2.55c.55.548.55 1.432.55 3.2s0 2.652-.55 3.2c-.548.55-1.432.55-3.2.55s-2.652 0-3.2-.55c-.55-.548-.55-1.432-.55-3.2' />
                            </svg>
                        </div>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li data-sidebar="menu-item">
                        <a href="{{ route('petugas.index') }}" data-sidebar="menu-button"
                            class="{{ request()->is('petugas') ? 'bg-sidebar-accent dark:bg-gray-700 font-medium' : '' }} transition-colors flex items-center p-2 text-sidebar-accent-foreground rounded-lg dark:text-white hover:bg-sidebar-accent dark:hover:bg-gray-700 group">
                            <div class="flex  items-center justify-center text-sidebar-foreground">
                                <svg width="24" height="24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                    stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" class="size-5">
                                    <path
                                        d='M17 19.5c0-1.657-2.239-3-5-3s-5 1.343-5 3m14-3c0-1.23-1.234-2.287-3-2.75M3 16.5c0-1.23 1.234-2.287 3-2.75m12-4.014a3 3 0 1 0-4-4.472M6 9.736a3 3 0 0 1 4-4.472m2 8.236a3 3 0 1 1 0-6 3 3 0 0 1 0 6' />
                                </svg>
                            </div>
                            <span class="ms-3">Petugas</span>
                        </a>
                    </li>
                    <li data-sidebar="menu-item">
                        <a href="{{ route('pejabats.index') }}" data-sidebar="menu-button"
                            class="flex items-center p-2 text-sidebar-accent-foreground rounded-lg dark:text-white hover:bg-sidebar-accent dark:hover:bg-gray-700 group">
                            <div class="flex  items-center justify-center text-sidebar-foreground">
                                <svg width="24" height="24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                    stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" class="size-5">
                                    <path
                                        d='M9.713 3.64c.581-.495.872-.743 1.176-.888a2.58 2.58 0 0 1 2.222 0c.304.145.595.393 1.176.888.599.51 1.207.768 2.007.831.761.061 1.142.092 1.46.204.734.26 1.312.837 1.571 1.572.112.317.143.698.204 1.46.063.8.32 1.407.83 2.006.496.581.744.872.889 1.176.336.703.336 1.52 0 2.222-.145.304-.393.595-.888 1.176a3.3 3.3 0 0 0-.831 2.007c-.061.761-.092 1.142-.204 1.46a2.58 2.58 0 0 1-1.572 1.571c-.317.112-.698.143-1.46.204-.8.063-1.407.32-2.006.83-.581.496-.872.744-1.176.889a2.58 2.58 0 0 1-2.222 0c-.304-.145-.595-.393-1.176-.888a3.3 3.3 0 0 0-2.007-.831c-.761-.061-1.142-.092-1.46-.204a2.58 2.58 0 0 1-1.571-1.572c-.112-.317-.143-.698-.204-1.46a3.3 3.3 0 0 0-.83-2.006c-.496-.581-.744-.872-.89-1.176a2.58 2.58 0 0 1 .001-2.222c.145-.304.393-.595.888-1.176.52-.611.769-1.223.831-2.007.061-.761.092-1.142.204-1.46a2.58 2.58 0 0 1 1.572-1.571c.317-.112.698-.143 1.46-.204a3.3 3.3 0 0 0 2.006-.83' />
                                    <path
                                        d='M14.5 9.25a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0M17 19.2c-.317-6.187-9.683-6.187-10 0' />
                                </svg>
                            </div>
                            <span class="ms-3">Penjabat</span>
                        </a>
                    </li>
                    <li data-sidebar="menu-item">
                        <a href="{{ route('petugas.user') }}" data-sidebar="menu-button"
                            class="{{ request()->is('petugas/user') ? 'bg-sidebar-accent dark:bg-gray-700 font-medium' : '' }} transition-colors flex items-center p-2 text-sidebar-accent-foreground rounded-lg dark:text-white hover:bg-sidebar-accent dark:hover:bg-gray-700 group">
                            <div class="flex  items-center justify-center text-sidebar-foreground">
                                <svg width="24" height="24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                    stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" class="size-5">
                                    <path
                                        d='M21 19.75c0-2.09-1.67-5.068-4-5.727m-2 5.727c0-2.651-2.686-6-6-6s-6 3.349-6 6m9-12.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m3 3a3 3 0 1 0 0-6' />
                                </svg>
                            </div>
                            <span class="ms-3">User</span>
                        </a>
                    </li>
                    <li data-sidebar="menu-item">
                        <a href="{{ route('checklist.index') }}" data-sidebar="menu-button"
                            class="{{ request()->is('checklist*') ? 'bg-sidebar-accent dark:bg-gray-700 font-medium' : '' }} transition-colors flex items-center p-2 text-sidebar-accent-foreground rounded-lg dark:text-white hover:bg-sidebar-accent dark:hover:bg-gray-700 group">
                            <div class="flex  items-center justify-center text-sidebar-foreground">
                                <svg width="24" height="24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                    stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" class="size-5">
                                    <path
                                        d='M5 20.25c0 .414.336.75.75.75h10.652C17.565 21 18 20.635 18 19.4v-1.445M5 20.25A2.25 2.25 0 0 1 7.25 18h10.152q.339 0 .598-.045M5 20.25V6.2c0-1.136-.072-2.389 1.092-2.982C6.52 3 7.08 3 8.2 3h9.2c1.236 0 1.6.437 1.6 1.6v11.8c0 .995-.282 1.425-1 1.555' />
                                    <path d='m9.6 10.323 1.379 1.575a.3.3 0 0 0 .466-.022L14.245 8' />
                                </svg>
                            </div>
                            <span class="ms-3">Checklist</span>
                        </a>
                    </li>
                    <li data-sidebar="menu-item">
                        <a href="{{ route('kendaraan.index') }}" data-sidebar="menu-button"
                            class="{{ request()->is('kendaraan*') ? 'bg-sidebar-accent dark:bg-gray-700 font-medium' : '' }} transition-colors flex items-center p-2 text-sidebar-accent-foreground rounded-lg dark:text-white hover:bg-sidebar-accent dark:hover:bg-gray-700 group">
                            <div class="flex  items-center justify-center text-sidebar-foreground">
                                <svg width="24" height="24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                    stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" class="size-5">
                                    <path
                                        d='M19.794 16.5A9 9 0 0 1 7.5 19.794M19.794 16.5A9 9 0 0 0 16.5 4.206M19.794 16.5 13.732 13M7.5 19.794A9 9 0 0 1 4.206 7.5M7.5 19.794l3.5-6.062M4.206 7.5A9 9 0 0 1 16.5 4.206M4.206 7.5l6.062 3.5M16.5 4.206 13 10.268M13.732 13a2 2 0 0 1-2.732.732M13.732 13A2 2 0 0 0 13 10.268m-2 3.464A2 2 0 0 1 10.268 11m0 0A2 2 0 0 1 13 10.268m.932 1.214 6.761-1.811m-8.175 4.26 1.811 6.762m-4.26-8.175-6.762 1.811m8.175-4.26L9.671 3.306' />
                                </svg>
                            </div>
                            <span class="ms-3">Kendaraan</span>
                        </a>
                    </li>
                @endif
                <li data-sidebar="menu-item">
                <li data-sidebar="menu-item">
                    <button data-sidebar="menu-button" data-collapse-toggle="pemeriksaan-menu"
                        class="flex items-center p-2 w-full text-sidebar-accent-foreground rounded-lg dark:text-white hover:bg-sidebar-accent dark:hover:bg-gray-700 [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0 group">
                        <div class="flex w-full">
                            <div class="flex items-center justify-center text-sidebar-foreground">
                                <svg width="24" height="24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                    stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" class="size-5">
                                    <path d='m9.75 11.742 1.039 1.181c.095.109.267.1.351-.016L13.25 10' />
                                    <path d='M19 11.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0m-2.107 5.42 3.08 3.08' />
                                </svg>
                            </div>
                            <span class="ms-3">Pemeriksaan</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </button>

                    <ul id="pemeriksaan-menu"
                        class="{{ request()->is('pemeriksaan*') ? '' : 'hidden' }}  my-2 space-y-2 ml-4 pl-4 border-l border-sidebar-border">
                        <li>
                            <a href="{{ route('pemeriksaan.create') }}?jenis=utama"
                                class="{{ request()->is('pemeriksaan/utama') ? 'bg-sidebar-accent dark:bg-gray-700 font-medium' : '' }} flex items-center w-full p-2 text-sidebar-accent-foreground transition duration-75 rounded-lg  group hover:bg-sidebar-accent dark:text-white dark:hover:bg-gray-700">
                                Kendaraan
                                Utama
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pemeriksaan.create') }}?jenis=pendukung"
                                class="{{ request()->is('pemeriksaan/pendukung') ? 'bg-sidebar-accent dark:bg-gray-700 font-medium' : '' }} flex items-center w-full p-2 text-sidebar-accent-foreground transition duration-75 rounded-lg  group hover:bg-sidebar-accent dark:text-white dark:hover:bg-gray-700">Kendaraan
                                Pendukung</a>
                        </li>
                        <li>
                            <a href="{{ route('pemeriksaan.create') }}?jenis=nt"
                                class="{{ request()->is('pemeriksaan/nt') ? 'bg-sidebar-accent dark:bg-gray-700 font-medium' : '' }} flex items-center w-full p-2 text-sidebar-accent-foreground transition duration-75 rounded-lg  group hover:bg-sidebar-accent dark:text-white dark:hover:bg-gray-700">Kendaraan
                                Pendukung NT</a>
                        </li>
                        <li>
                            <a href="{{ route('pemeriksaan.recap') }}"
                                class="{{ request()->is('pemeriksaan/rekap') ? 'bg-sidebar-accent dark:bg-gray-700 font-medium' : '' }} flex items-center w-full p-2 text-sidebar-accent-foreground transition duration-75 rounded-lg  group hover:bg-sidebar-accent dark:text-white dark:hover:bg-gray-700">Rekap</a>
                        </li>

                    </ul>
                </li>
                <a href="{{ route('view.showpdf') }}" data-sidebar="menu-button"
                    class="flex items-center p-2 text-sidebar-accent-foreground rounded-lg dark:text-white hover:bg-sidebar-accent dark:hover:bg-gray-700 group">
                    <div class="flex  items-center justify-center text-sidebar-foreground">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                            xmlns="http://www.w3.org/2000/svg" class="size-5">
                            <path
                                d='M12 8.94V18m5-9.06V18M7 8.94V18m5.447-14.894 7.764 3.908c.944.475.608 1.907-.447 1.907H4.236c-1.055 0-1.391-1.432-.447-1.907l7.764-3.908a1 1 0 0 1 .894 0M19.5 21h-15a1.5 1.5 0 0 1 0-3h15a1.5 1.5 0 0 1 0 3' />
                        </svg>
                    </div>
                    <span class="ms-3">Lihat REGULASI</span>
                </a>
                </li>
                <li data-sidebar="menu-item">
                    <a href="{{ route('login-logs.index') }}" data-sidebar="menu-button"
                        class="flex items-center p-2 text-sidebar-accent-foreground rounded-lg dark:text-white hover:bg-sidebar-accent dark:hover:bg-gray-700 group">
                        <div class="flex  items-center justify-center text-sidebar-foreground">
                            <svg width="24" height="24" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round"
                                stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" class="size-5">
                                <path
                                    d='M12 9.8V20m0-10.2c0-1.704.107-3.584-1.638-4.473C9.72 5 8.88 5 7.2 5H4.6C3.364 5 3 5.437 3 6.6v8.8c0 .568-.036 1.195.546 1.491.214.109.493.109 1.052.109H7.43c2.377 0 3.26 1.036 4.569 3m0-10.2c0-1.704-.108-3.584 1.638-4.473C14.279 5 15.12 5 16.8 5h2.6c1.235 0 1.6.436 1.6 1.6v8.8c0 .567.035 1.195-.546 1.491-.213.109-.493.109-1.052.109h-2.833c-2.377 0-3.26 1.036-4.57 3' />
                            </svg>
                        </div>
                        <span class="ms-3">Log Book</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div data-sidebar="footer" class="flex flex-col gap-2 p-4 pt-0">
        <button data-sidebar="menu-button" data-dropdown-toggle="footer-menu">
            <div
                class="peer/menu-button flex w-full px-2 items-center gap-2 overflow-hidden rounded-md text-left outline-none ring-sidebar-ring transition-[width,height,padding] focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-[[data-sidebar=menu-action]]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground data-[state=open]:hover:bg-sidebar-accent data-[state=open]:hover:text-sidebar-accent-foreground group-data-[collapsible=icon]:!size-8 [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0 hover:bg-sidebar-accent hover:text-sidebar-accent-foreground h-12 text-sm group-data-[collapsible=icon]:!p-0">
                <div
                    class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                        xmlns="http://www.w3.org/2000/svg" class="size-5">
                        <path d='M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0' />
                        <path d='M14.5 9.25a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0M17 19.5c-.317-6.187-9.683-6.187-10 0' />
                    </svg>
                </div>
                <div class="grid flex-1 text-left text-sm leading-tight">
                    <span class="truncate font-semibold">{{ Auth::user()->name }}</span>
                    <span class="truncate text-xs">{{ Auth::user()->role }}</span>
                </div>
                <div>
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                        xmlns="http://www.w3.org/2000/svg" class="size-5">
                        <path d='m8 16 4 4 4-4M8 8l4-4 4 4' />
                    </svg>
                </div>
        </button>

        <!-- Footer menu -->
        <div id="footer-menu"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRightButton">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>
