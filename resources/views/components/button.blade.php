<button type="{{ $type ?? 'button' }}"
    class="flex items-center justify-center font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition-colors {{ $class }} {{ $color == 'primary' ? 'text-primary-foreground bg-primary hover:bg-primary-800 focus:ring-4 focus:ring-muted' : ($color == 'danger' ? 'text-red-primary-foreground bg-red-primary hover:bg-red-700 focus:ring-4 focus:ring-muted' : 'text-accent-foreground bg-background hover:bg-accent focus:ring-4 focus:ring-muted shadow-sm border') }}"
    {{ $attributes }}>
    {{ $slot }}
</button>
