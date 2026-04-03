<?php

use Livewire\Component;
use App\Jobs\MailMan;

new class extends Component
{
    public $contact_package = [
        'name' => '',
        'message' => ''
    ];

    public function email(){
        $this->validate([
           'contact_package.name'=>'required|min:1',
           'contact_package.message'=>'required|min:2' 
        ]);

    }

    public function resume()
    {
        return response()->download(
            public_path('KareemWilliams_Resume.pdf'),
            'KareemWilliams_Resume.pdf'
        );
    }
};
?>

@placeholder
<footer class="w-full min-h-[80px] flex items-center justify-center">
    <img class="h-[35px] animate-pulse my-5 mb-15" loading="lazy" src="{{ asset('brwncreative.svg') }}"
        alt="brwncreative logo">
</footer>
@endplaceholder

<footer class="mt-8" x-data="{
inputs: $wire.entangle('contact_package')
}
">
    {{-- Trusted By Section --}}
    <section id="trusted-by" class="mb-6 flex items-center justify-center flex-col gap-3">
        <hgroup class="text-center">
            <h1 class="text-4xl font-medium">Trusted By</h1>
            <p class="text-[1.2rem]">Innovators and market leaders like</p>
        </hgroup>
        <div class="trust-list w-[100%] relative flex items-center justify-center" x-data="{
            logos: ['bmelectronics','hyatt','pbs','vgor']
            }">
            <ul class="flex flex-wrap items-center justify-center h-full">
                <template x-for="(logo , logo_index) in logos" :key='logo_index+`-{{ rand(0,1000) }}`'>
                    <li class=" h-[100px] w-[100px] p-3 box-border">
                        <div
                            class="h-full w-full border rounded border-gray-300 box-border p-3 flex items-center justify-center bg-white shadow-md shadow-black/30">
                            <img loading="lazy" :src="`trusted/${logo}.webp`" :alt="`${logo}-logo`"
                                class="max-h-full max-w-full">
                        </div>
                    </li>
                </template>
            </ul>
        </div>
    </section>
    {{-- Contact Me --}}
    <section id="contact-me" class="flex items-center justify-center flex-col gap-3 pb-10 px-5 box-border">
        <div class="border shadow-md border-gray-400 rounded-2xl w-[450px] max-sm:w-[100%] p-3 box-border">
            <hgroup class="mb-4">
                <h2 class="text-2xl font-medium">Contact Me</h2>
                <div class="contacts mt-2 flex flex-wrap gap-1">
                    <a class="text-[1rem] truncate p-2 border border-gray-400 bg-gray-100 px-4 rounded-4xl py-1"
                        href="mailto:kareem.williams@brwncreative.com">kareem.williams@brwncreative.com</a>
                    <p class="text-[1rem] line-clamp-1 p-2 border border-gray-400 bg-gray-100 px-4 rounded-4xl py-1">
                        1(868)768-7915
                    </p>
                </div>
            </hgroup>
            <div class="inputs flex flex-col gap-3">
                <input x-model="inputs.name" size="1" type="text" placeholder="Name"
                    class="border text-[1.1rem] border-gray-400 rounded-xl px-4 py-2">
                <textarea x-model="inputs.message" size="1" type="text" placeholder="Message"
                    class="border border-gray-400 rounded-lg px-4 py-2 text-[1.1rem]"></textarea>
            </div>
            <div class="actions flex gap-4 box-border bg-gray-100 rounded-4xl mt-4 p-3 border border-gray-400">
                <a :href="`https://wa.me/18687687915?text= Hi my name is ${inputs.name}; ${inputs.message}`"
                    class="py-2 truncate px-3 w-full border border-gray-400 shadow-md shadow-black/30 rounded-4xl flex items-center justify-center text-[1.1rem] gap-3"><i
                        class="bi bi-whatsapp"></i> WhatsApp</a>
            </div>
        </div>
        <button x-on:click="$wire.resume()"
            class="flex w-[450px] max-sm:w-[100%] items-center justify-center gap-4 px-5 py-2 bg-brwn text-white rounded-4xl border-b shadow-md shadow-[#643e34]/80 border-[#643e34] text-[1.1rem]">
            <i class="bi bi-box-arrow-down"></i> Download Resume
        </button>
    </section>
    {{-- Disclaimer --}}
    <div class="flex items-center justify-center">
        <img class="h-[35px] my-5 mb-15" loading="lazy" src="{{ asset('brwncreative.svg') }}" alt="brwncreative logo">
    </div>
</footer>