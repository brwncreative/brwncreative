<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

new #[Layout('layouts::app')] class extends Component
{
    #[Url('view')]
    public $viewing = 'web';
};
?>

<main x-data="{
viewing: $wire.entangle('viewing'),
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
                <a wire:navigate.hover href="?view=digital" x-on:click="viewing = `digital`" class="text-2xl cursor-pointer select-none transition-all"
                    :class="viewing == 'web' ? `text-white` : null">Digital</p>
                <a wire:navigate.hover href="?view=web" x-on:click="viewing = `web`" class="text-2xl cursor-pointer select-none transition-all"
                    :class="viewing == 'web' ? `text-white` : null">Web</p>
            </div>
        </nav>
    </header>
    {{-- Main --}}
    <template x-if="viewing == 'web'">
        <livewire:web />
    </template>
    <template x-if="viewing == 'digital'">
        <livewire:graphics />
    </template>
</main>