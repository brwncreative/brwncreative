<?php

use Livewire\Component;
use App\Jobs\MailMan;

new class extends Component
{
    public $contact_package = [
        'name' => '',
        'message' => ''
    ];

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

<footer x-data="{
inputs: $wire.entangle('contact_package')
}
">
    {{-- Sticker --}}
    <div class="flex h-[0px] relative items-center justify-center">
        <img class="h-[50px] absolute top-[-25px]" loading="lazy" src="{{ asset('brwncreative_w_offset.svg') }}"
            alt="brwncreative logo">
    </div>
    {{-- About Me --}}
    <section id="about-me"
        class="px-5 py-5 pt-7 pb-10 max-lg:pt-15 flex gap-15 min-h-[250px] flex items-center max-lg:flex-col max-lg:gap-5">
        <div
            class="img relative h-[200px] rounded max-lg:h-[150px] w-[25%] max-lg:w-[35%] overflow-hidden flex items-center justify-center">
            <img class="absolute top-[-25px] max-lg:top-0 max-w-full"
                src="{{ asset('kareem_williams_brwncreative.webp') }}" alt="kareem-williams-brwncreative">
        </div>
        <div>
            <hgroup>
                <h2 class="text-5xl tracking-tight  font-medium max-lg:text-center">About Me</h2>
                <p class="text-[1.2rem] max-lg:text-[1rem] max-w-[800px] mt-4">Hi there, my name is Kareem
                    'Brwncreative'
                    Williams, and I continue to cultivate my skillsets in digital media and software development, off
                    the heels of receiving my tertiary education. As an art kid, turned curious nerdy teen and now
                    realized adult, I marry my creative indulgence with the technicality, and potential, of the software
                    and web spaces, to create solutions and experiences that are well rounded, unique and beneficial to
                    any and all of my end users/ consumers. </p>
            </hgroup>
            <button x-on:click="$wire.resume()"
                class="flex w-[450px] max-lg:w-full cursor-pointer active:opacity-50 mt-5 items-center justify-center gap-4 px-5 py-2 bg-brwn text-white rounded-4xl text-[1.1rem]">
                <i class="bi bi-box-arrow-down"></i> Download Resume
            </button>
        </div>
    </section>
    {{-- Contact Me --}}
    <section id="contact-me" class="flex flex-wrap">
        <a  href="mailto:kareem.williams@brwncreative.com" class="py-3 border hover:bg-gray-200 w-[50%] flex items-center justify-center gap-4 bg-gray-100 text-[1.5rem]">
            Mail <i class="bi bi-arrow-up-right"></i>
        </a>
        <a href="https://wa.me/18687687915?text=I would like to work with you" class="py-3 border hover:bg-gray-200 w-[50%] flex items-center justify-center gap-4 bg-gray-100 text-[1.5rem]">
            Whatsapp <i class="bi bi-arrow-up-right"></i>
        </a>
        <a href="https://www.instagram.com/brwncreativestudio/?hl=en" class="py-3 border hover:bg-gray-200 w-[50%] flex items-center justify-center gap-4 bg-gray-100 text-[1.5rem]">
            Instagram <i class="bi bi-arrow-up-right"></i>
        </a>
        <a href="https://www.facebook.com/brwncreativestudio/" class="py-3 border hover:bg-gray-200 w-[50%] flex items-center justify-center gap-4 bg-gray-100 text-[1.5rem]">
           Facebook <i class="bi bi-arrow-up-right"></i>
        </a>
    </section>
</footer>