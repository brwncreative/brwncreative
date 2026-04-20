<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;

new #[Layout('layouts::app')] class extends Component
{
    #[Computed]
    public function projects()
    {
        return DB::table('projects')->inRandomOrder()->limit(8)->get();
    }
    #[Computed]
    public function offerings()
    {
        return file_get_contents(resource_path('/offerings.json'));
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

<main x-data="{
init(){
  const ld = document.createElement('script');
  ld.type = 'application/ld+json';
  ld.setAttribute('data-navigate-track',true);
    @verbatim
  ld.text = JSON.stringify({
    '@context':`https://schema.org`,
    '@type': `Organization`,
    '@id':'https://brwncreative.com',
    'url': 'https://www.brwncreative.com',
    'logo':'https://brwncreative.com/brwncreative.svg',
    'name':'Brwncreative',
    'acceptedPaymentMethod':`['Debit Card','Credit Card','Bank Wire']`,
    'aggregateRating': {'@type':'AggregateRating','itemReviewed':'Web Development','ratingCount':'5','reviewCount':'15'},
    'priceRange':'$',
    'openingHours':['Mo-Sa 8:00-20:00'],
    'telephone':'(868) 768-7915',
    'email':'kareem.williams@brwncreative.com',
    'keywords':['e-commerce','small-business','business','service','web development','flyers','logos','digital media','animation'],
    'hasOfferCatalog': {
    '@type':'OfferCatalog',
    'name':'Digital and Software Development Servics',
    'itemListElement':[
        {
            '@type':'OfferCatalog',
            'name':'Digital Services',
            'itemListElement': [
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'Flyer'}},
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'Logos'}},
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'Animation'}},
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'Video Editing'}},
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'3D'}}
            ]
        },
             {
            '@type':'OfferCatalog',
            'name':'Software Development Services',
            'itemListElement': [
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'E-Commerce'}},
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'Blog'}},
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'E-Catalog'}},
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'Mobile Apps'}},
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'Desktop Apps'}},
            {'@type':'Offer','itemOffered':{'@type':'Service','name':'Single Page Apps'}}
            ]
        }
    ]
    },
    'slogan':'Building business identities with digital and web',
    'legalName':'Kareem Williams',
    'contactPoint': [
    {
    '@type':'ContactPoint',
    'telephone':'+1-868-768-7915',
    'contactType':'Work Phone'
    }
    ]
  });
      @endverbatim
  document.head.append(ld);
 }
}">
    {{-- Quick Navigation --}}
    <header>
        <nav class="px-5 flex items-center relative w-full min-h-[65px] border-b border-gray-300">
            <a wire:navigate href="/">
                <img loading="lazy" class="h-[35px]" src="{{ asset('brwncreative.svg') }}"
                    alt="Brwncreative Mascot Vector">
            </a>
        </nav>
    </header>
    {{-- Elevator Pitch --}}
    <section id="Elevator Pitch"
        class="px-5 grid grid-cols-[max-content_1fr] min-h-[200px] max-md:grid-cols-1 max-md:grid-rows-[max-content_max-content]">
        <div id="brain-lottie" class="brain-lottie h-[200px]" x-data="{
            init(){
               lottie.loadAnimation({
                container: document.getElementById('brain-lottie'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: 'brain_swords.json' 
            })
            }
            }"></div>
        <hgroup class="flex flex-col text-left justify-center py-10">
            <h1 class="text-6xl max-md:text-4xl tracking-tight robofont capitalize font-medium mb-3">
                <span class="font-bold">Its a No Brainer. </span> <br>
                Get your
                business online,
                faster
            </h1>
            <p class="text-[1.5rem] max-md:text-[1.3rem] max-w-[500px] leading-8"> Every day your business remains
                <b>Offline</b> you're
                missing out
                and someone's
                <b>Cashing in.</b> Let me flip the script for you!
            </p>
        </hgroup>
    </section>
    {{-- Trusted By --}}
    <section id="Trusted By"
        class="px-5 overflow-hidden flex items-center justify-center my-5 mt-0 relative border border-gray-300 py-5" x-data="{
            logos: ['bmelectronics','hyatt','pbs','vgor']
            }">
        <div class="h-full w-[200px] max-sm:w-[50px] absolute left-0 bg-gradient-to-r from-white to-white/0 z-2">
        </div>
        <div class="h-full w-[200px] max-sm:w-[50px] absolute right-0 bg-gradient-to-l from-white to-white/0 z-2">
        </div>
        <p class="text-[150px] text-gray-100  absolute left-0 text-nowrap max-sm:text-[100px]">Trusted By</p>
        <div class=" w-full flex justify-around overflow-hidden">
            <div class="w-max flex gap-[1rem] pr-[1rem] justify-around scroll">
                <template x-for="(logo , logo_index) in logos" :key='logo_index+`-{{ rand(0,1000) }}`'>
                    <div class="card h-[5em] max-sm:min-w-[150px] min-w-[250px]">
                        <div class="h-full w-full flex items-center justify-center  shadow-black/30">
                            <img loading="lazy" :src="`trusted/${logo}.webp`" :alt="`${logo}-logo`"
                                class="max-h-[70%] max-w-[70%]">
                        </div>
                    </div>
                </template>
            </div>
            <div aria-hidden class="w-max flex gap-[1rem] pr-[1rem] justify-around scroll">
                <template x-for="(logo , logo_index) in logos" :key='logo_index+`-{{ rand(0,1000) }}`'>
                    <div class="card h-[5em] max-sm:min-w-[150px] min-w-[250px]">
                        <div class="h-full w-full flex items-center justify-center  shadow-black/30">
                            <img loading="lazy" :src="`trusted/${logo}.webp`" :alt="`${logo}-logo`"
                                class="max-h-[70%] max-w-full">
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
    {{-- Portfolio --}}
    <section id="Portfolio" class="px-5 mt-10" x-data="
    {
    portfolio: {{ $this->projects }}
    }">
        <hgroup>
            <h1 class="text-5xl max-md:text-3xl font-medium">Portfolio</h1>
            <hr class="my-3">
        </hgroup>
        <div class="flex flex-wrap gap-[.5%] max-md:gap-[.8%]">
            <template x-for="(project, project_index) in portfolio" :key="project_index">
                <div x-on:click="$dispatch('see-project',{id: project.id})"
                    class="w-[24.5%] cursor-pointer max-lg:w-[32.8%] max-md:w-[49.2%] mt-[.5%] min-h-[300px] flex flex-col gap-2">
                    <div class="img h-[250px] bg-gray-100 flex items-center justify-center overflow-hidden">
                        <img loading="lazy" class="w-full" :src="`{{ asset('/') }}${project.cover}`"
                            :alt="project.name">
                    </div>
                    <span class="flex">
                        <p class="text-2xl w-full truncate" x-text="project.name"></p>
                    </span>
                </div>
            </template>
        </div>
        {{-- See Project --}}
        <livewire:display.project :key="'display.project'.time()" defer />
    </section>
    {{-- Services --}}
    <section id="Services" x-data="{
    services: {{ $this->offerings }},
    viewing: false,
    current: null,
    setCurrent(service){
    this.current = service;
    this.viewing = true;
    }
    }">
        <hgroup class="px-5">
            <h1 class="text-5xl max-md:text-3xl font-medium">Services and Pricing</h1>
            <hr class="my-3">
        </hgroup>
        <div class="bg-brwn border-t border-b border-[#3e1602] h-max w-full p-5 py-10 flex gap-3 overflow-x-scroll">
            <template x-if="viewing == false">
                <template x-for="(service, service_index) in services" :key="service_index">
                    <div class="rounded-3xl h-max bg-white shadow-lg shadow-black/30 px-5 py-4 w-[250px] min-w-[250px]">
                        <h2 class="text-3xl text-[#3e1602] tracking-tight font-medium capitalize mb-3"
                            x-text="service.title"></h2>
                        <p class="leading-6" x-text="service.description"></p>
                        <p class="tracking-tight text-3xl font-medium my-4" x-text="service.pricing"></p>
                        <p class="text-gray-600 mb-5 text-sm" x-text="service.disclaimer"></p>
                        <a href="`https://wa.me/18687687915?text=Can you tell me more about ${service.title} and how we can work together?`" class="bg-black shadow-lg shadow-black/30 text-white px-4 rounded-4xl h-[35px] w-full text-[1.1rem] flex gap-3 items-center justify-center">Get Started<i class="bi bi-arrow-up-right"></i></a>
                    </div>
                </template>
            </template>
        </div>
    </section>
    {{-- About Me --}}
    <section id="About-Me" class="my-5">
        <hgroup class="px-5">
            <h1 class="text-5xl max-md:text-3xl font-medium">About Me</h1>
            <hr class="my-3">
        </hgroup>
        <div
            class="px-5 grid grid-cols-[max-content_1fr] min-h-[200px] max-md:grid-cols-1 max-md:grid-rows-[max-content_max-content]">
            <div class="relative w-max">
                <img loading="lazy" class="absolute z-3 right-[20px] top-[-10px] h-[50px]"
                    src="{{ asset('brwncreative_mascot.svg') }}" alt="Brwncreative Mascot">
                <div
                    class="img relative h-[200px] w-[200px] flex justify-center items-center overflow-hidden rounded-lg shadow-md mr-15">
                    <img loading="lazy" src="{{ asset('kareem_williams_brwncreative.webp') }}"
                        alt="Kareem Williams aka Brwncreative">
                </div>
            </div>
            <hgroup class="flex flex-col text-left justify-center max-md:mt-10">
                <h1 class="text-4xl max-md:text-3xl tracking-tight robofont capitalize font-medium mb-3">
                    Hi there, my name is Kareem
                    <span class="text-brwn">'Brwncreative'</span>
                    Williams,
                </h1>
                <p class="text-[1.1rem] leading-7"> I continue to cultivate my skillsets in digital
                    media
                    and software development off
                    the heels of receiving my tertiary education. As an art kid, turned curious nerdy teen and now
                    realized adult, I marry my creative indulgence with the technicality, and potential, of the software
                    and web spaces. I strive to create solutions and experiences that are well rounded, unique and beneficial to
                    any and all of my end users/ consumers.
                </p>
            </hgroup>
        </div>
        <section id="resume" class="px-5 my-10">
            <hgroup class="flex gap-4">
                <h3 class="text-3xl font-medium">Resume Snip</h3>
                <button x-on:click="$wire.resume()"
                    class="bg-brwn px-3 text-white cursor-pointer active:opacity-50">Download Resume</button>
            </hgroup>
            <hr class="my-4">
            <article>
                <hgroup>
                    <h3 class="font-bold text-2xl">Kareem Williams</h3>
                    <p class="font-medium">Digital Media Professional, Marketer, Artist and Full Stack Web Developer</p>
                    <p>With over half a decade of experience in web development, customer service and digital media, I
                        try to be adequately equipped for any responsibility delegated to me; I strive to be an asset to
                        those I work with in a collaborative setting and eagerly seek new standards for self-improvement
                        at all turns. </p>
                </hgroup>
                <section id="resume-work-experience" class="mt-5">
                    <h2 class="text-2xl font-medium">Most Recent Work Experience</h2>
                    <hr>
                    <hgroup>
                        <h3 class="font-bold">BM Electronics</h3>
                        <p>(Assistant Marketing and Sales Manager, Web Developer, Content Creator)</p>
                    </hgroup>
                    <ul class="list-disc pl-10">
                        <li>Created 2D advertisements for all social media platforms.</li>
                        <li>Liaised with company sales teams frequently, to coordinate effective campaigns and provide
                            promotional material when necessary. </li>
                        <li>Re introduced Hire Purchase to the retail arm of the business, to increase customer buying
                            power and subsidize slow periods. </li>
                        <li>Oversaw the company’s TikTok page leading to a 6,000+ follower increase, 250% viewership and
                            engagement increase and new demographic opportunities.</li>
                        <li>Developed www.bmelectronics.com and www.maxsonicelite.com to function as information hubs, a
                            means to instill confidence in stakeholders, and e-commerce solutions. Notably,
                            www.bmelectronics.com received 2,200 new users and 35,000 interactions in its first month,
                            and maintains around 100 users daily (per google analytics). Both sites load under one
                            second, even with heavy web traffic, and score over 90 in SEO optimization (per lighthouse).
                        </li>
                        <li>Worked with previous manager on public outreach and philanthropic initiatives</li>
                        <li>Engaged in telemarketing, email marketing, retail sales and B2B sales.</li>
                        <li>Generated performance reports, marketing analyses and presentations for upper management.
                        </li>
                        <li>Acted as a provisional HR assistant, vetting new hires and onboarding 3 employees of my own.
                        </li>
                    </ul>
                </section>
                <section id="education-and-achievements" class="mt-5">
                    <h2 class="text-2xl font-medium">Education and Achievements</h2>
                    <hr>
                    <hgroup>
                        <h3 class="font-bold">University of the West Indies</h3>
                        <p>B.Sc. Information Technology (Special)</p>
                    </hgroup>
                    <hgroup>
                        <h3 class="font-bold">St. Benedict’s College, La Romaine, Trinidad</h3>
                        <p>9 O-Level Passes, 8 A-Level Passes, Digital Media U1 Trinidad Top Scorer (Merit List)</p>
                    </hgroup>
                    <hgroup>
                        <h3 class="font-bold">BM Electronics Limited</h3>
                        <p>- Appointed assistant marketing and sales manager in under a year</p>
                    </hgroup>
                </section>
                <section id="education-and-achievements" class="mt-5">
                    <h2 class="text-2xl font-medium">Interests and Hobbies</h2>
                    <hr>
                    <ul class="list-disc pl-10">
                        <li>Exploring trends in the creative, tech and gaming industries</li>
                        <li>Watching documentaries</li>
                        <li>I am, unfortunately, a league of legends player </li>
                        <li>I enjoy debating</li>
                        <li>Documenting experiences and teaching
                        </li>
                        <li>I’ve always loved Lego, assembly toys and as a hobby when I was younger, I made structures
                            out of all four and go fish decks.</li>
                        <li>I exercise frequently, especially when I am heavy into office work and</li>
                    </ul>
                </section>
            </article>
        </section>
    </section>
</main>