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
}" class="transition-all min-h-screen {{ $viewing == 'web' ? 'bg-black' : null }}" >
    {{-- Quick Navigation --}}
    <header class="w-full flex items-center h-[80px] mb-3">
        <nav class="flex items-center justify-center relative w-full">
            <a wire:navigate href="/login" class="absolute left-5">
                <img loading="lazy" class="h-[30px]" src="{{ asset('brwncreative_mascot.webp') }}"
                    alt="Brwncreative Mascot Vector">
            </a>
            {{-- Choices --}}
            <div class="flex gap-4 items-center">
                <a wire:navigate.hover href="?view=digital" x-on:click="viewing = `digital`"
                    class="text-2xl cursor-pointer select-none transition-all"
                    :class="viewing == 'web' ? `text-white` : null">Digital</p>
                </a>
                <a wire:navigate.hover href="?view=web" x-on:click="viewing = `web`"
                    class="text-2xl cursor-pointer select-none transition-all"
                    :class="viewing == 'web' ? `text-white` : null">Web</p>
                </a>
            </div>
        </nav>
    </header>
    {{-- Main --}}
    @if($viewing == 'web')
    <livewire:web :key="'web-view-'.time()" />
    @endif
    @if($viewing == 'digital')
    <livewire:graphics :key="'digital-view-'.time()" />
    @endif
</main>