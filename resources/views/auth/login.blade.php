<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex flex-col gap-6">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex flex-col items-center gap-2">
                <a href="#" class="flex flex-col items-center gap-2 font-medium">
                    <div class="flex h-16 w-16 items-center justify-center rounded-md">
                        <img src="{{ asset('img/airport.png') }}" alt="Logo" >

                    </div>
                    <span class="sr-only">{{ env('APP_NAME', 'Laravel') }}</span>
                </a>
                <h1 class="text-xl font-bold">Selamat Datang di {{ env('APP_NAME', 'Laravel') }}</h1>
                <div class="text-center text-sm">Tidak punya akun?
                    <a href="{{ route('register') }}" class="underline underline-offset-4">Register</a>
                </div>
            </div>
            <div class="grid gap-2">
                <div class="flex flex-col gap-6">
                    <div class="grid gap-2">
                        <label
                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                            for="email">Email
                        </label>
                        <input type="email"
                            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                            id="email" placeholder="m@gmail.com" name="email" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="grid gap-2">
                        <label
                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                            for="password">Password
                        </label>
                        <input type="password"
                            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                            id="password" required="" name="password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <button
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 py-2 w-full"
                        type="submit">Login
                    </button>
                </div>
                <div
                    class="relative text-center text-sm after:absolute after:inset-0 after:top-1/2 after:z-0 after:flex after:items-center after:border-t after:border-border">
                    <span class="relative z-10 bg-background px-2 text-muted-foreground">Atau</span>
                </div>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('login-token') }}"
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 w-full">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5"
                            class="size-4" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d='M9.697 4 6.678 21M17.054 4l-3.019 17M21 8.781H3m18 7.438H3' />
                        </svg>
                        Login dengan Token
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
