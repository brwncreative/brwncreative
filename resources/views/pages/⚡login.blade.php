<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

new #[Layout('layouts::dashboard')] class extends Component
{
    public $email, $password, $message;

    public function login()
    {
        $this->validate(['email' => 'required|email', 'password' => 'required|min:5']);
        $user = DB::table('users')->where('email', '=', $this->email)->first(['name', 'email', 'password']);
        if ($user) {
            if (Hash::check($this->password, $user->password)) {
                // User has been authenticated
                session()->regenerate();
                session()->put('user', $user);
                redirect()->route('dashboard');
            } else {
                $this->message = 'Password may be incorrect';
            }
        } else {
            $this->message = 'User does not seem to exist';
        }
    }
};
?>

<main class="w-full h-screen flex flex flex-col items-center justify-center px-5 box-border" x-data="{
    email: $wire.entangle('email'),
    password: $wire.entangle('password')
}">
    <a wire:navigate href="/">
        <img src="{{ asset('brwncreative.svg') }}" class="h-[45px] mb-8 appear opacity-0"
            alt="Brwncreative Logo Long-Variant">
    </a>
    <section id="login-container" class="w-[500px] max-lg:w-[100%] shadow-md rounded-lg appear opacity-0"
        style="animation-delay: 100ms">
        <hgroup class="leading-10 flex gap-4 items-center">
            <h1 class="text-4xl font-medium">Login</h1>
            <div wire:loading role="status">
                <svg aria-hidden="true" class="w-8 h-8 text-neutral-tertiary animate-spin fill-brand"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </hgroup>
        <div class="inputs flex flex-col gap-5 my-3">
            <div class="input flex flex-col gap-1">
                <label for="email">Email</label>
                <input x-model="email" type="text" class="px-3 py-1 rounded border border-gray-400 outline-0"
                    placeholder="Email">
            </div>
            <div class="input flex flex-col gap-1">
                <label for="password">Password</label>
                <input x-model="password" type="password" class="px-3 py-1 rounded border border-gray-400 outline-0"
                    placeholder="*******">
            </div>
        </div>
        @if($errors->any())
        <div class="errors flex my-3 flex-wrap gap-1">
            @foreach($errors->all() as $key => $error)
            <p class="text-red-500 border border-red-500 px-3 py-1 bg-red-50 rounded-4xl">{{ $error }}</p>
            @endforeach
        </div>
        @endif
        @if($message)
        <div class="errors flex my-3 flex-wrap gap-1">
            <p class="text-red-500 border border-red-500 px-3 py-1 bg-red-50 rounded-4xl">{{ $message}}</p>
        </div>
        @endif
        <button x-on:click="$wire.login()"
            class="bg-black text-white cursor-pointer active:opacity-50 select-none px-5 w-full py-2 rounded-lg shadow-lg shadow-black/50">Login</button>
    </section>
</main>