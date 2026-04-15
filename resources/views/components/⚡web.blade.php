<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;

new class extends Component
{
    #[Computed]
    public function projects()
    {
         return DB::table('projects')->where('type','=','web')->inRandomOrder()->limit(6)->get();
    }
};
?>

<main class="text-white pb-25" x-data="{
 
}">
    {{-- Introduction --}}
    <hgroup class="px-5 flex items-center justify-center flex-col gap-4 text-center">
        <div id="brain" class="h-[250px]"></div>
        <script>
            lottie.loadAnimation({
                container: document.getElementById('brain'), // the dom element that will contain the animation
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: 'brain_swords.json' // the path to the animation json
            });
        </script>
        <h1 class="text-7xl max-lg:text-6xl robofont capitalize appear opacity-0 max-w-[600px] break-words font-medium">
            <span class="font-medium">Its a No Brainer. </span> <br>
            Get your
            business online,
            faster
        </h1>
        <p class="text-[1.2rem] px-5 mt-1 appear opacity-0 max-w-[500px] mt-2 break-words"
            style="animation-delay: 100ms">
            Every day your business remains <b>offline</b> is a day of <b>lost revenue and missed leads.</b> Let your
            competitors be
            the ones stuck in 'coming soon' limbo and let me cut through the technical noise and <b>open those digital
                doors for you before the market moves on.</b>
        </p>
    </hgroup>
    {{-- What we offer --}}
    <section id="services" class="flex items-center justify-center my-12 appear px-5 opacity-0"
        style="animation-delay: 200ms" x-data="{
       offerings:[
        ['e-commerce','bi bi-cart-fill', 'text-[#52a341]'],
        ['blog','bi bi-bookmark-heart-fill','text-[#a073ef]'],
        ['e-catalog','bi bi-send-fill','text-[#39bbcc]'],
        ['mobile apps','bi bi-phone-fill','text-[#e378cf]'],
        ['desktop apps','bi bi-laptop-fill','text-[#de7c59]'],
        ['single page apps','bi bi-dice-1-fill','text-[#f2df5e]']
    ],
    highlighting: 0,
    init(){
    window.setInterval(()=>{
    if(this.highlighting + 1 < this.offerings.length){
    this.highlighting += 1;
    }else{
    this.highlighting = 0;
    }
    },3000)
    }
    }">
        <div class="flex items-center gap-2 justify-center flex-wrap">
            <template x-for="(offer, offer_index) in offerings" :key="`web-${offer_index}-${new Date()}`">
                <div class="p-2 bg-[#212121] rounded-4xl" :class="highlighting == offer_index ? `roomy` : null">
                    <div
                        class="select-none flex items-center gap-3 p-1 px-5 pl-3 bg-black rounded-4xl transition-all cursor-pointer">
                        <i :class="`${offer[1]} ${offer[2]}`" class="text-sm"></i>
                        <p x-text="offer[0]" class="capitalize text-lg"></p>
                    </div>
                </div>
            </template>
        </div>
    </section>
    {{-- Guarantees --}}
    <div class="px-5 min-[1200px]:px-10 appear opacity-0 mb-10" style="animation-delay: 300ms">
        <hgroup>
            <h2 class="text-4xl robofont">Guarantees</h2>
            <p class="text-lg">Here are just a few guarantees you get when we make you a website</p>
        </hgroup>
        <hr class="my-4 mb-7 border-[#2c2c2c]">
        {{-- List --}}
        <div class="list mt-5" x-data="{
        guarantees: [
        ['SEO Optimization','Get your website seen! We take special care to ensure your website is well formatted and search compliant so you appear higher on results regardless of traffic.','bi bi-search-heart'],
        ['Mobile/ Tablet friendly',`Websites aren't just made for the computer; Your website will work on every device ensuring users have a seamless experience and you don't have to compromise your vision`,'bi bi-phone'],
        ['Speed',`You're not slowing down so why should your website? We keep load times down so even patient users are surprised, even with 10,000 users!`,'bi bi-speedometer2'],
        ['Security Best Practice',`We follow cyber security best practices to ensure your, and your clients', data is secure.`,'bi bi-fingerprint']
        ]
        }">
            <ul class="flex flex-wrap gap-4 max-md:gap-0 justify-center">
                <template x-for="(guarantee, guarantee_index) in guarantees" :key="guarantee_index">
                    {{-- Gurantee --}}
                    <li class="guarantee max-md:w-[50%] w-[250px] max-md:px-3 max-md:even:pl-0 max-md:odd:pr-0 mb-5">
                        <div class="bg-gray-200 rounded p-3 pb-5 px-5 text-black w-full">
                            <div
                                class="w-[50px] h-[50px] shadow-lg shadow-black/40 flex items-center justify-center text-[1.8rem] border-b border-gray-800 mb-4 bg-gray-300 rounded-4xl">
                                <i :class="guarantee[2]"></i>
                            </div>
                            <hgroup>
                                <h3 class="text-3xl capitalize break-words max-sm:break-all robofont leading-8 tracking-tight mb-5"
                                    x-text="guarantee[0]"></h3>
                                <p x-text="guarantee[1]"></p>
                            </hgroup>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
    </div>
    {{-- Portfolio --}}
    <div class="px-5 min-[1200px]:px-10 appear opacity-0 mb-10" style="animation-delay: 400ms">
        <hgroup>
            <h2 class="text-4xl robofont">Previous Work</h2>
            <p class="text-lg max-w-[250px]">
                Check out what i've done!
            </p>
        </hgroup>
        <hr class="mt-4 border-[#2c2c2c]">
        {{-- List --}}
        <div class="flex flex-wrap gap-[1.3%] max-sm:gap-[1%]" x-data="{
        projects: {{ $this->projects }}
        }">
            <template x-for="(project, project_index) in projects" :key="project_index">
                <div class="w-[32%] max-sm:w-[49%] mt-5 hover:opacity-80 cursor-pointer"
                    x-on:click="$dispatch('see-project',{id: project.id})">
                    <div
                        class="img bg-accent h-[200px] relative overflow-hidden flex items-center justify-center rounded">
                        <template x-if="Object.keys(JSON.parse(project.media)).length > 0">
                            <img loading="lazy" class="w-full min-h-max"
                                :src="`${Object.values(JSON.parse(project.media)).find(media => media.purpose == 'cover').image}`"
                                alt="">
                        </template>
                        <div class="w-full h-[50px] absolute bottom-0 left-0 bg-gradient-to-t from-black/50 to-white/0">
                        </div>
                    </div>
                    <hgroup class="mt-3">
                        <p x-text="project.name" class="text-[1.2rem] font-bold"></p>
                        <div class="tags my-2 flex gap-1 line-clamp-1">
                            <template x-for="(tag, tag_index) in JSON.parse(project.tags)">
                                <p x-text="tag"
                                    class="py-1 capitalize px-3 line-clamp-1 text-ellipsis bg-[#2a2a2a] rounded-4xl">
                                </p>
                            </template>
                        </div>
                    </hgroup>
                </div>
            </template>
        </div>
    </div>
    {{-- See Project --}}
    <livewire:display.project :key="'display.project'.time()" defer />
    {{-- Rates --}}
    <div class="px-5 min-[1200px]:px-10 appear opacity-0" style="animation-delay: 500ms" x-data="{
    current: 'easy',
    }">
        <hgroup>
            <h2 class="text-4xl robofont">Packages <strong class="text-2xl">(USD)</strong></h2>
            <p class="text-lg max-w-[250px]">
                Here's a breakdown of what we offer
            </p>
        </hgroup>
        <hr class="my-4 mb-7 border-[#2c2c2c]">
        <div class="navigation flex items-center justify-center my-4">
            <div class="p-2 bg-[#212121] flex gap-1 rounded-4xl">
                <div x-on:click="current = current == 'e-commerce' ? 'easy' : 'e-commerce'"
                    class="select-none p-1 px-5 bg-black rounded-4xl cursor-pointer">
                    <p class="line-clamp-1">E-Commerce</p>
                </div>
                <div x-on:click="current = 'easy'" class="select-none p-1 px-5 bg-black rounded-4xl cursor-pointer">
                    <p class="line-clamp-1">Easy Start</p>
                </div>
                <div x-on:click="current = current == 'web-brwn' ? 'easy' : 'web-brwn'"
                    class="select-none p-1 px-5 bg-black rounded-4xl cursor-pointer">
                    <p class="line-clamp-1">Web <sup>Brwn</sup> </p>
                </div>
            </div>
        </div>
        <div class="list mt-5">
            <ul class="relative overflow-hidden w-full h-[600px] flex items-center justify-center">
                {{-- E-Commerce --}}
                <li :class="current == 'e-commerce' ? 'scale-[1.05] !translate-x-[0%] z-20 shadow-lg shadow-black/70' : null"
                    class="border transition-all flex flex-col items-center text-black duration-300 border-gray-800 translate-x-[-80%] w-[300px] rounded-xl box-border bg-gray-200 absolute">
                    <hgroup
                        class="p-5 bg-gradient-to-t from-gray-300 to-gray-200 border-b border-gray-400 w-full relative rounded-t-lg">
                        <h2 class="text-3xl font-medium text-gray-600">E-Commerce</h2>
                        <p class="text-xl">The new face of wholesale/retail</p>
                    </hgroup>
                    <ul class="list-disc w-full pl-10 my-3">
                        <li>3 - 5 Page Website</li>
                        <li>Mailing List and Marketing Mail</li>
                        <li>3 Email Accounts</li>
                        <li>Quick Load Times</li>
                        <li>SEO Optimized</li>
                        <li>Mobile and Tablet friendly</li>
                        <li>Sopping Cart/ Wishlist</li>
                        <li>Marketing tools</li>
                        <li>Customer data collection</li>
                        <li>Automatic invoicing</li>
                    </ul>
                    <hgroup class="leading-8 w-full px-5">
                        <p>Starting from</p>
                        <p class="text-6xl robofont">$445</p>
                        <p class="text-gray-700 leading-5 text-sm mt-2">Domain free for one year. Maintenance costs do
                            apply after site is finished</p>
                    </hgroup>
                    <a href="https://wa.me/18687687915?text=Can you tell me about the E-Commerce package?"
                        class="my-3 w-[90%] flex items-center justify-center gap-3 rounded-2xl text-white py-3 shadow-lg bg-black">Get
                        Started <i class=" bi bi-arrow-up-right"></i></a>
                </li>
                {{-- Easy Start --}}
                <li :class="current == 'easy' ? 'scale-[1.05] !translate-x-[0%] z-20 shadow-lg shadow-black/70' : current == 'e-commerce' ? 'translate-x-[-80%]' : current == 'web-brwn' ? 'translate-x-[80%]' : null"
                    class="border text-black transition-all flex flex-col items-center duration-300 z-10 border-gray-800 w-[300px] rounded-xl box-border bg-gray-200 absolute">
                    <div
                        class="absolute z-10 top-[-15px] bg-white rounded-4xl px-5 py-1 border-b border-gray-500 shadow-md shadow-gray-400">
                        Popular</div>
                    <hgroup
                        class="p-5 bg-gradient-to-t from-gray-300 to-gray-200 border-b border-gray-400 w-full relative rounded-t-lg">
                        <h2 class="text-3xl font-medium text-gray-600">Easy Start</h2>
                        <p class="text-xl">Get your idea off the ground today!</p>
                    </hgroup>
                    <ul class="list-disc w-full pl-10 my-3">
                        <li>3 - 5 Page Website</li>
                        <li>Mailing List and Marketing Mail</li>
                        <li>3 Email Accounts</li>
                        <li>Quick Load Times</li>
                        <li>SEO Optimized</li>
                        <li>Mobile and Tablet friendly</li>
                    </ul>
                    <hgroup class="leading-8 w-full px-5">
                        <p>Starting from</p>
                        <p class="text-6xl robofont">$150</p>
                        <p class="text-gray-700 leading-5 text-sm mt-2">Domain free for one year. Maintenance costs do
                            apply after site is finished</p>
                    </hgroup>
                    <a href="https://wa.me/18687687915?text=Can you tell me about the Easy Start package?"
                        class="my-3 w-[90%] flex items-center justify-center gap-3 rounded-2xl text-white py-3 shadow-lg bg-black">Get
                        Started <i class=" bi bi-arrow-up-right"></i></a>
                </li>
                {{-- Web Brwn --}}
                <li :class="current == 'web-brwn' ? 'scale-[1.05] !translate-x-[0%] z-20 shadow-lg shadow-black/70' : null"
                    class="border text-black transition-all  flex flex-col items-center duration-300 border-gray-800 translate-x-[80%] w-[300px] rounded-xl box-border bg-gray-200 absolute">
                    <div
                        class="absolute z-10 top-[-15px] bg-white rounded-4xl px-5 py-1 border-b border-[#412610] shadow-md shadow-black/50">
                        Popular</div>
                    <hgroup
                        class="p-5 text-white bg-gradient-to-t from-[#624126] to-[#8a5e3b] border-b border-[#3f2917] w-full relative rounded-t-lg">
                        <h2 class="text-3xl font-medium">Web <sup>Brwn</sup></h2>
                        <p class="text-xl">Take your business to the next level</p>
                    </hgroup>
                    <ul class="list-disc w-full pl-10 my-3">
                        <li>3 - 5 Page Website</li>
                        <li>Mailing List and Marketing Mail</li>
                        <li>3 Email Accounts</li>
                        <li>Quick Load Times</li>
                        <li>SEO Optimized</li>
                        <li>Mobile and Tablet friendly</li>
                    </ul>
                    <ul class="list-disc w-full pl-10 my-3 text-[#624126]">
                        <li>Call in support</li>
                        <li>Custom Animations and Icons</li>
                        <li>Fully integrated Dashboard</li>
                        <li>Complex features</li>
                        <li>Marketing tools</li>
                    </ul>
                    <hgroup class="leading-8 w-full px-5">
                        <p>Starting from</p>
                        <p class="text-6xl robofont">$750</p>
                        <p class="text-gray-700 leading-5 text-sm mt-2">Domain free for one year. Maintenance costs do
                            apply after site is finished</p>
                    </hgroup>
                    <a href="https://wa.me/18687687915?text=Can you tell me about the Web Brwn package?"
                        class="my-3 w-[90%] flex items-center justify-center gap-3 rounded-2xl text-white py-3 shadow-lg bg-black">Get
                        Started <i class=" bi bi-arrow-up-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
</main>