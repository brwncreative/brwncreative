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
};
?>

<main id="digital-page" x-data="{
    featured: {{ json_encode($this->featured) }}
}">
    {{-- Introduction --}}
    <section class="appear px-10" id="introduction">
        <hgroup class="text-center flex flex-col gap-4 items-center justify-center">
            <h1 class="text-7xl max-w-[500px] robofont">
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
            <template x-for="(offer, offer_index) in offerings" :key="`digital-${offer_index}`">
                <div class="p-2 bg-gray-100 rounded-4xl"  :class="highlighting == offer_index ? `roomy` : null">
                    <div
                        class="select-none flex items-center gap-3 p-1 px-5 pl-3 bg-white shadow-md rounded-4xl cursor-pointer" >
                        <i :class="`${offer[1]} ${offer[2]}`" class="text-sm"></i>
                        <p x-text="offer[0]" class="capitalize text-lg"></p>
                    </div>
                </div>
            </template>
        </div>
    </section>
    {{-- Featured --}}
    <section id="featured" class="flex items-center justify-center appear opacity-0" style="animation-delay: 100ms">
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
</main>