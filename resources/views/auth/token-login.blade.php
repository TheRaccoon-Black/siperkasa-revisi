<x-guest-layout>
    <div class="flex flex-col gap-6">
        <form method="POST" action="{{ url('/login-token') }}">
            @csrf
            <div class="flex flex-col items-center gap-2">
                <a href="#" class="flex flex-col items-center gap-2 font-medium">
                    {{-- <div class="flex h-8 w-8 items-center justify-center rounded-md">
                        <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"
                            class="size-6">
                            <path
                                d='M7.805 3.469C8.16 3.115 8.451 3 8.937 3h6.126c.486 0 .778.115 1.132.469l4.336 4.336c.354.354.469.646.469 1.132v6.126c0 .5-.125.788-.469 1.132l-4.336 4.336c-.354.354-.646.469-1.132.469H8.937c-.5 0-.788-.125-1.132-.469L3.47 16.195c-.355-.355-.47-.646-.47-1.132V8.937c0-.5.125-.788.469-1.132z' />
                            <path d='m8.667 12.633 1.505 1.721a1 1 0 0 0 1.564-.073L15.333 9.3' />
                        </svg>

                    </div> --}}
                    <div class="flex h-16 w-16 items-center justify-center rounded-md">
                        <img src="{{ asset('img/airport.png') }}" alt="Logo" >

                    </div>
                    <span class="sr-only">{{ env('APP_NAME', 'Laravel') }}</span>
                </a>
                <h1 class="text-xl font-bold">Login ke {{ env('APP_NAME', 'Laravel') }}</h1>
                <div class="text-center text-sm">Login dengan Password?
                    <a href="{{ route('login') }}" class="underline underline-offset-4">Sini</a>
                </div>
            </div>
            <div class="grid gap-2">
                <div class="flex flex-col gap-6">
                    <div class="grid gap-2">
                        <label
                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                            for="token">Token
                        </label>
                        <input type="text"
                            class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                            id="token" required="" name="token">
                        @if (session('error'))
                            <x-input-error :messages="session('error')" class="mt-2" />
                        @endif
                    </div>
                    <button
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 py-2 w-full"
                        type="submit">Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>