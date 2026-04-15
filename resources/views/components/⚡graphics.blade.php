<?php

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;

new class extends Component
{
    #[Computed()]
    public function featured()
    {
        return DB::table('projects')->where('type', '=', 'digital')->inRandomOrder()->first();
    }

    #[Computed]
    public function projects()
    {
        return DB::table('projects')->where('type', '=', 'digital')->inRandomOrder()->limit(6)->get();
    }
};
?>

<main id="digital-page" x-data="{
    featured: {{ json_encode($this->featured) }},
}">
    {{-- Introduction --}}
    <section class="appear px-10 overflow-hidden" id="introduction">
        <hgroup class="text-center relative flex flex-col gap-4 items-center justify-center">
            <h1 class="text-7xl max-sm:text-6xl max-sm:max-w-[700px] max-w-[500px] robofont">
                I put the Digital in <span class="font-medium">Digital Media</span>
            </h1>
            <p class="max-w-[500px] text-[1.2rem]">
                I'm an all rounder that likes the fine lines; I bridge the gap between technicality and
                creativity and leverage all my skills to capture the audiences you want. From Graphics to Animation,
                <span class="font-medium">I help you to build on your vision rather than compromise on it.</span>
            </p>
        </hgroup>
    </section>
    {{-- What we offer --}}
    <section id="services" class="flex items-center justify-center my-12 appear px-5 opacity-0"
        style="animation-delay: 200ms" x-data="{
       offerings:[
        ['logos','bi bi-pencil-square', 'text-[#E08115]'],
        ['flyers','bi bi-newspaper','text-[#14073B]'],
        ['animation','bi bi-film','text-[#053F04]'],
        ['video editing','bi bi-camera-reels-fill','text-[#5C390A]'],
        ['3D','bi bi-box','text-[#0F75BD]'],
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
            <template x-for="(offer, offer_index) in offerings" :key="`digital-${offer_index}-${new Date()}`">
                <div class="p-2 bg-gray-100 rounded-4xl" :class="highlighting == offer_index ? `roomy` : null">
                    <div
                        class="select-none flex items-center gap-3 p-1 px-5 pl-3 bg-white shadow-md rounded-4xl cursor-pointer">
                        <i :class="`${offer[1]} ${offer[2]}`" class="text-sm"></i>
                        <p x-text="offer[0]" class="capitalize text-lg"></p>
                    </div>
                </div>
            </template>
        </div>
    </section>
    {{-- Trusted By Section --}}
    <section id="trusted-by" class="px-5 flex items-center justify-center mb-10" x-data="{
            logos: ['bmelectronics','hyatt','pbs','vgor']
            }">
        <div class=" w-[80%] flex justify-around overflow-hidden">
            <div class="w-max flex gap-[1rem] pr-[1rem] justify-around  scroll">
                <template x-for="(logo , logo_index) in logos" :key='logo_index+`-{{ rand(0,1000) }}`'>
                    <div class="card h-[5em] max-sm:min-w-[150px] min-w-[250px]">
                        <div class="h-full w-full flex items-center justify-center  shadow-black/30">
                            <img loading="lazy" :src="`trusted/${logo}.webp`" :alt="`${logo}-logo`"
                                class="max-h-[80%] max-w-full">
                        </div>
                    </div>
                </template>
            </div>
            <div aria-hidden class="w-max flex gap-[1rem] pr-[1rem] justify-around  scroll">
                <template x-for="(logo , logo_index) in logos" :key='logo_index+`-{{ rand(0,1000) }}`'>
                    <div class="card h-[5em] max-sm:min-w-[150px] min-w-[250px]">
                        <div class="h-full w-full flex items-center justify-center  shadow-black/30">
                            <img loading="lazy" :src="`trusted/${logo}.webp`" :alt="`${logo}-logo`"
                                class="max-h-[80%] max-w-full">
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
    {{-- Featured --}}
    <section id="featured" class="flex items-center justify-center appear opacity-0 mb-10"
        style="animation-delay: 100ms">
        <div class="w-full bg-gray-100 p-3 px-5 box-border">
            <div
                class="bg-white w-full p-5 h-full shadow-md shadow-black/30 border border-l-3 border-l-gray-500 border-gray-300 rounded-l-[0px] rounded grid grid-cols-[max-content_1fr] gap-5">
                <div class="h-full w-[50px] border p-3 border rounded shadow-md flex items-center justify-center">
                    <img class="max-h-full"
                        :src="Object.values(JSON.parse(featured.media)).find(image => image['purpose'] == 'cover')['image']"
                        alt="">
                </div>
                <hgroup>
                    <h2 class="text-4xl font-medium" x-text="featured.name"></h2>
                    <div class="flex flex-wrap gap-2">
                        <p class="capitalize flex items-center text-brwn"><i
                                class="bi bi-stars animate-pulse"></i><span>Featured</span></p>
                        <template x-for="(tag, tag_index) in JSON.parse(featured.tags)" :key="tag_index">
                            <p class="text-blue-700" x-text="`#${tag}`"></p>
                        </template>
                    </div>
                    <p class="text-[1.1rem]" x-text="featured.problem"></p>
                </hgroup>
            </div>
        </div>
    </section>
    {{-- Portfolio --}}
    <div class="px-5 min-[1200px]:px-10 appear opacity-0 mb-10" style="animation-delay: 200ms">
        <hgroup>
            <img class="h-[35px]" src="{{ asset('previous_work.svg') }}" alt="Previous Work">
            <p class="text-lg max-w-[250px]">
                Check out what i've done!
            </p>
        </hgroup>
        {{-- List --}}
        <div class="flex flex-wrap gap-[1.3%] max-sm:gap-[1%] mt-3" x-data="{
        projects: {{ $this->projects }}
        }">
            <template x-for="(project, project_index) in projects" :key="project_index">
                <div class="w-[32%] max-sm:w-[49%] mt-5 hover:opacity-80 cursor-pointer"
                    x-on:click="$dispatch('see-project',{id: project.id})">
                    <div
                        class="img bg-gray-100 h-[200px] relative overflow-hidden flex items-center justify-center rounded">
                        <template x-if="Object.keys(JSON.parse(project.media)).length > 0">
                            <img loading="lazy" class="w-full min-h-max"
                                :src="`${Object.values(JSON.parse(project.media)).find(media => media.purpose == 'cover').image}`"
                                alt="">
                        </template>
                    </div>
                    <hgroup class="mt-3">
                        <p x-text="project.name" class="text-[1.2rem] font-bold"></p>
                        <div class="tags my-2 flex gap-1 line-clamp-1">
                            <template x-for="(tag, tag_index) in JSON.parse(project.tags)">
                                <p x-text="tag"
                                    class="py-1 capitalize px-3 line-clamp-1 text-ellipsis bg-gray-200 rounded-4xl">
                                </p>
                            </template>
                        </div>
                    </hgroup>
                </div>
            </template>
        </div>
    </div>
    {{-- Pricing --}}
    <div class="px-5 min-[1200px]:px-10 appear opacity-0 mb-25" style="animation-delay: 600ms">
        <hgroup>
            <img class="h-[45px]" src="{{ asset('pricing.svg') }}" alt="Previous Work"> <strong
                class="text-2xl">(USD)</strong>
            <p class="text-lg max-w-[250px]">
                Competitive pricing for all budgets
            </p>
        </hgroup>
        {{-- Price Blocks --}}
        <div class="mt-5 pb-5 h-max overflow-x-auto flex items-center justify-center">
            <div class="flex flex-col h-[400px] flex-wrap w-max" x-data="{
        pricing: [
        {category: 'logos',price:'36','note':null},
        {category: 'flyers', price:'52','note':'Get an animted version for +$250.00'},
        {category: 'video editing', price:'30', note :'/15 seconds'},
        {category: 'animated flyer', price:'52', note :null},
        {category: 'branding package', price:'221', note :null},
        {category: 'social media', price:'89', note :'/month. The starting amount gives you 6 static posts and 1 reel'}
        ]
        }">
                <template x-for="(price, price_index) in pricing" :key="price_index">
                    <div
                        class="h-[50%] w-[200px] min-w-[200px] hover:bg-gray-50 border border-gray-300 box-border p-5 py-4">
                        <hgroup>
                            <h2 class="text-3xl capitalize wrap-break-word" x-text="price.category"></h2>
                            <hr class="my-2">
                            <p>Starting from:</p>
                            <p class="font-medium text-3xl mt-4 robotext" x-text="`$${Number(price.price).toFixed(2)}`">
                            </p>
                            <p class="text-gray-600 text-[1.05rem]" x-text="price.note"></p>
                        </hgroup>
                    </div>
                </template>
            </div>
        </div>
    </div>
    {{-- See Project --}}
    <livewire:display.project :key="'display.project'.time()" defer />
</main>