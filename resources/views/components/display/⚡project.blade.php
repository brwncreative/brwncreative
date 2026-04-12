<?php

use Livewire\Component;
use Illuminate\Support\Facades\DB;

new class extends Component
{
    public $project;
    public function getProject($id)
    {
        $this->project = DB::table('projects')->find($id);
    }
    public function clearProject(){
        $this->project = null;
    }
};
?>

@placeholder
<section id="project-highlight-container">

</section>
@endplaceholder

<section id="project-highlight-container" x-data="{
project: $wire.entangle('project'),
visible: false,
see(id){
$wire.getProject(id);
this.visible = true;
},
close(){
this.visible = false;
$wire.clearProject()
}
}" x-show="visible" x-cloak x-on:see-project.window="see($event.detail.id)"
    :class="visible ? `pointer-events-all` : `pointer-events-all`"
    class="fixed justify-center top-0 left-0 flex w-full h-full bg-black/50 z-5">
    <i x-on:click="close"
        class="bi bi-x z-20 flex items-center justify-center w-[30px] h-[30px] cursor-pointer hover:opacity-50 bg-white/20 text-white max-lg:bg-black/50 absolute right-5 top-5"></i>
    <div class="w-[70%] max-lg:w-[100%] relative bg-white text-black overflow-y-auto">

        {{-- Media --}}
        <template x-if="project">
            <template x-for="(media,media_index) in JSON.parse(project.media)" :key="media_index + new Date()">
                <img :src="media.image" :alt="`${project.name}-image-${media.image}`">
            </template>
        </template>
        <hr class="border border-brwn border-2">
        {{-- Breakdown --}}
        <template x-if="project">
            <hgroup class="p-5 flex flex-col gap-4">
                <h1 class="text-3xl font-medium" x-text="project.name">
                </h1>
                <div class="problem flex flex-col gap-[1px] p-3 px-4 shadow-md border border-gray-300">
                    <p class="font-medium text-[1.2rem]">Prompt</p>
                    <p x-text="project.problem"></p>
                </div>
                <div class="process flex flex-col gap-[1px]">
                    <p class="font-medium text-[1.2rem]">Process</p>
                    <p x-text="project.explanation"></p>
                </div>
                <hr>
                <div class="actions flex flex-col justify-center items-center">
                    <img style="width: 180px;"
                        src="https://drive.google.com/thumbnail?id=1tq5Vjp4KCWUZdu1uCxCwdiMEyf8Gf-Hd&sz=h200"
                        alt="brwn_logo_email">
                    <a :href="`https://wa.me/18687687915?text=I liked the ${project.name} project, can you tell me some more about it?`"
                        class="w-full rounded-lg border border-brwn text-brwn py-3 px-3 mt-4 text-[1.3rem] shadow-md flex items-center justify-center">I like
                        this</a>
                </div>
            </hgroup>
        </template>

        {{-- Loading --}}
        <div wire:loading.class="!opacity-100"
            class="absolute pointer-events-none opacity-0 top-0 bg-gray-200/50 left-0 h-full w-full flex items-center justify-center "
            role="status">
            <svg aria-hidden="true" class="w-8 h-8 text-neutral-tertiary animate-spin fill-brand" viewBox="0 0 100 101"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</section>