<section class="sm:ml-64">
    <header class="sticky top-0 flex shrink-0 items-center gap-2 border-b bg-background p-4">
        <button
            class="inline-flex visible sm:hidden  items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-7 w-7 -ml-1"
            data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                <path d='M4.5 6.5h15M4.5 12h15m-15 5.5h15' class="size-5" />
            </svg>
        </button>
        <div data-orientation="vertical" role="none" class="shrink-0 bg-border w-[1px] mr-2 h-4"></div>

        @yield('breadcrumbs')
    </header>
</section>
