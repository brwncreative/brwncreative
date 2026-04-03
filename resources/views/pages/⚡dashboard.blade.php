<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

new #[Layout('layouts::dashboard')] class extends Component
{
    #[Url(as: 'menu')]
    public $current_menu;

    public function setMenu($menu)
    {
        $this->current_menu = $menu;
    }
    public function logout()
    {
        session()->regenerate();
        session()->remove('user');
        redirect()->route('home');
    }
};
?>

<section id="dashboard" x-data="{
    menus:['portfolio','mail','clients'],
    current_menu: $wire.entangle('current_menu'),
}">
    {{-- Navigation --}}
    <header>
        <nav>
            <div class="header py-5 px-5">
                <a wire:navigate href="/dashboard">
                    <img class="h-[30px]" src="{{ asset('brwncreative.svg') }}" alt="">
                </a>
            </div>
            <div class="navigation flex gap-2 pb-5 overflow-x-auto px-5">
                <template x-for="(menu, menu_index) in menus" :key="menu_index">
                    <a wire:navigate :href="`?menu=${menu}`"
                        :class="menu == current_menu ? `!text-black bg-gray-100 shadow-md shadow-black/30` : null"
                        class="capitalize text-gray-500 transition-all duration-200 hover:bg-gray-100 cursor-pointer select-none text-[.95rem] min-w-max px-3 py-1 border border-gray-400 rounded-4xl"
                        x-text="menu"></a>
                </template>
                <p x-on:click="$wire.logout()"
                    class="capitalize flex items-center gap-2 text-red-500 transition-all duration-200 bg-red-50 cursor-pointer select-none text-[.95rem] min-w-max px-3 py-1 border border-red-400 rounded-4xl">
                    <i class="bi bi-door-closed-fill"></i> Logout
                </p>
            </div>
        </nav>
    </header>
    <hr class="border border-gray-300 mb-5 border-dashed">
    {{-- Main --}}
    @if($current_menu == 'clients')
    <livewire:dashboard.clients defer :key='`clients-menu-`.time()' />
    @endif
    @if($current_menu == 'portfolio')
    <livewire:dashboard.portfolio defer :key="`portfolio-menu`.time()" />
    @endif
    @if($current_menu == 'shop')
    <div></div>
    @endif
    @if($current_menu == null)
    <div class="px-5">
        <hgroup>
            <h1 class="text-4xl">Welcome back <b>Kareem</b>, <br> let's get this <b>Money!</b></h1>
        </hgroup>
    </div>
    @endif
</section>