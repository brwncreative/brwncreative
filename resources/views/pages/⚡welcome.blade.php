<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts::app')] class extends Component
{
    //
};
?>

<main x-data="{
viewing: 'web',
}" class="transition-all min-h-screen" :class="viewing == `web` ? `bg-black` : null">
    {{-- Quick Navigation --}}
    <header class="w-full flex items-center h-[80px] mb-3">
        <nav class="flex items-center justify-center relative w-full">
            <a wire:navigate href="/login" class="absolute left-5">
                <img loading="lazy" class="h-[30px]" src="{{ asset('brwncreative_mascot.webp') }}"
                    alt="Brwncreative Mascot Vector">
            </a>
            {{-- Choices --}}
            <div class="flex gap-4 items-center">
                <p x-on:click="viewing = `digital`" class="text-2xl cursor-pointer select-none transition-all"
                    :class="viewing == 'web' ? `text-white` : null">Digital</p>
                <p x-on:click="viewing = `web`" class="text-2xl cursor-pointer select-none transition-all"
                    :class="viewing == 'web' ? `text-white` : null">Web</p>
            </div>
        </nav>
    </header>
    {{-- Main --}}
    <template x-if="viewing == 'web'">
        <livewire:web />
    </template>
    <template x-if="viewing == 'digital'">
        <div>dsadsa</div>
    </template>
</main>