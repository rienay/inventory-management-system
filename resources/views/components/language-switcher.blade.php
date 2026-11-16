@php
    $currentLocale = app()->getLocale();
    $languages = [
        'id' => [
            'name' => 'Bahasa Indonesia',
            'code' => 'ID',
        ],
        'en' => [
            'name' => 'English',
            'code' => 'ENG',
        ],
    ];
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <button @click="open = ! open" type="button" class="inline-flex items-center justify-center h-9 px-3 text-xs sm:text-sm font-medium rounded-md border border-input bg-background hover:bg-accent hover:text-accent-foreground transition-colors gap-2 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-1">
        <x-heroicon-o-globe-alt class="w-4 h-4 text-muted-foreground" />
        <span class="font-bold text-xs tracking-wider text-foreground">{{ $languages[$currentLocale]['code'] ?? strtoupper($currentLocale) }}</span>
        <svg class="h-3 w-3 text-muted-foreground transition-transform duration-200" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
    </button>

    <div x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 z-50 mt-1.5 w-44 rounded-md shadow-lg bg-card border border-border py-1"
        style="display: none;"
        @click="open = false">
        
        @foreach($languages as $code => $lang)
            <a href="{{ route('locale.switch', $code) }}" 
               class="flex items-center justify-between px-3 py-2 text-xs sm:text-sm hover:bg-muted transition-colors {{ $currentLocale === $code ? 'font-semibold text-primary bg-muted/60' : 'text-foreground' }}">
                <span class="flex items-center gap-2">
                    <span class="inline-block w-8 text-center px-1 py-0.5 text-[11px] font-bold rounded {{ $currentLocale === $code ? 'bg-primary text-primary-foreground' : 'bg-muted text-muted-foreground' }}">
                        {{ $lang['code'] }}
                    </span>
                    <span>{{ $lang['name'] }}</span>
                </span>
                @if($currentLocale === $code)
                    <svg class="h-4 w-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
        @endforeach
    </div>
</div>
