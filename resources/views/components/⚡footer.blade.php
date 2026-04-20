<?php

use Livewire\Component;
use App\Jobs\MailMan;

new class extends Component
{

};
?>

@placeholder
<footer class="w-full min-h-[80px] flex items-center justify-center">
    <img class="h-[35px] animate-pulse my-5 mb-15" loading="lazy" src="{{ asset('brwncreative.svg') }}"
        alt="brwncreative logo">
</footer>
@endplaceholder

<footer x-data="{
}
">
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