<?php

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Remove;
use App\Http\Controllers\Upload;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $projects, $project = [
        'id' => null,
        'cover' => null,
        'type' => 'web',
        'name' => null,
        'tags' => [],
        'turnaround' => null,
        'explanation' => null,
        'problem' => null,
        'media' => []
    ], $media = [];

    public function deleteImage($how = null, $key = null, $url = null, $list = null)
    {
        switch ($how) {
            case 'local':
                unset($this->project['media'][$key]);
                $this->media = array_values($this->media);
                break;
            case 'server':
                Remove::file($url);
                Project::where('id', '=', $this->project['id'])->update(['media' => json_encode(array_values($this->project['media']), JSON_FORCE_OBJECT | JSON_UNESCAPED_SLASHES)]);
                self::getProjects();
                break;
        }
    }
    public function editImages($how, $key, $to)
    {
        switch ($how) {
            case 'move':
                if (array_key_exists($key, $this->project['media'])) {
                    $out = array_splice($this->project['media'], $key, 1);
                    array_splice($this->project['media'], $to, 0, $out);
                }
                break;
            case 'cover':
                if (gettype($this->project['media'][$key]) == 'object') {
                    $this->project['cover'] = $key;
                } else {
                    $this->project['cover'] = $this->project['media'][$key];
                }
                break;
        }
    }
    public function editProject($work)
    {
        $work['tags'] = json_decode($work['tags'], true);
        $work['media'] = json_decode($work['media'], true);
        $this->project = $work;
    }
    public function getProjects()
    {
        $this->projects = DB::table('projects')->get()->chunk(10);
    }
    public function saveProject()
    {
        $this->validate([
            'project.name' => 'required|min:1',
            'project.tags' => 'required|array|min:1',
            'project.problem' => 'required',
            'project.explanation' => 'required'
        ]);
        $project = Project::updateOrCreate([
            'id' => $this->project['id']
        ], [
            'name' => $this->project['name'],
            'type' => $this->project['type'],
            'tags' => json_encode($this->project['tags'], JSON_FORCE_OBJECT | JSON_UNESCAPED_SLASHES),
            'turnaround' => $this->project['turnaround'],
            'explanation' => $this->project['explanation'],
            'problem' => $this->project['problem'],
            'media' => json_encode([], JSON_FORCE_OBJECT | JSON_UNESCAPED_SLASHES),
        ]);
        foreach ($this->project['media'] as $index => $media) {
            if (gettype($media) == 'object') {
                $url = Upload::image($media, $project);
                if ($index == $this->project['cover'] && array_key_exists($index, $this->project['media'])) {
                    $this->project['cover'] = $url;
                }
                $this->project['media'][$index] = $url;
            }
        }
        $project->media = json_encode(array_values($this->project['media']), JSON_FORCE_OBJECT | JSON_UNESCAPED_SLASHES);
        $project->cover = $this->project['cover'];
        $project->save();
        self::getProjects();
        self::fresh();
    }
    public function deleteProject($id)
    {
        Remove::directory(public_path('projects/' . $id));
        DB::table('projects')->delete($id);
        self::getProjects();
    }
    public function fresh()
    {
        $this->project = [
            'id' => null,
            'type' => 'web',
            'name' => null,
            'tags' => [],
            'turnaround' => null,
            'explanation' => null,
            'problem' => null,
            'media' => []
        ];
    }
    public function updated($property)
    {
        if ($property == 'media') {
            foreach ($this->media as $key => $image) {
                array_push($this->project['media'], $image);
            }
            $this->media = [];
        }
    }
    public function mount()
    {
        self::getProjects();
    }
};
?>

<main id="portfolio" class="px-5 w-full" x-data="{
works: $wire.entangle('projects'),
work: $wire.entangle('project'),
page: 0,
tag_text: '',
addTag(){
    if(this.tag_text.length > 2){
    this.work.tags.push(this.tag_text);
    }
    this.tag_text = null;
},
removeTag(key){
this.work.tags.splice(key,1);
},
deleteImageServer(key){
url = this.work.media[key];
this.work.media.splice(key,1);
$wire.deleteImage('server',key,url,this.work.media);
}
}">
    <section id="portfolio-management-container" class="grid grid-cols-2">
        {{-- Database Entries --}}
        <div class="db">
            <div
                class="w-full border border-gray-400 p-3 px-4 box-border flex flex-col gap-3 overflow-y-auto max-h-[500px] h-[500px]">
                <template x-for="(work, work_index) in works[page]">
                    <div :class="work.type == 'web' ? `border-l-amber-500` : `border-l-blue-500`"
                        class="w-full border-l-4 bg-gray-100 p-3 px-4 border border-gray-400 shadow-md shadow-black/20 box-border">
                        <hgroup>
                            <p x-text="work.name" class="font-medium"></p>
                            <p x-text="work.type" class="capitalize"></p>
                            <p x-text="work.explanation" class="text-gray-600 line-clamp-1"></p>
                        </hgroup>
                        <div class="actions flex gap-2 justify-end mt-2">
                            <i x-on:click="$wire.editProject(work)"
                                class="bi bi-pencil border hover:opacity-50 border-gray-400 cursor-pointer active:opacity-50 bg-white rounded-lg shadow-black/40 w-[35px] h-[35px] shadow-lg flex items-center justify-center"></i>
                            <i x-on:click="$wire.deleteProject(work.id)"
                                class="bi bi-trash3 hover:opacity-50 border border-red-400 text-red-500 cursor-pointer active:opacity-50 bg-red-50 rounded-lg shadow-red-700/40 w-[35px] h-[35px] shadow-lg flex items-center justify-center"></i>
                        </div>
                    </div>
                </template>
                <template x-if="works.length < 1">
                    <p class="break-works text-2xl max-w-[200px] text-gray-500 capitalize animate-pulse">No projects
                        have been entered to the
                        site yet</p>
                </template>
            </div>
        </div>
        {{-- Database Entry Form --}}
        <div class="form px-5 flex flex-col gap-2">
            <hgroup>
                <h1 class="text-3xl gap-3 flex items-center font-medium">Portfolio Form
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
                    <button x-on:click="$wire.fresh()"
                        class="bg-gray-100 cursor-pointer active:opacity-50 font-normal border border-gray-300 text-xl p-3 py-1">Clear</button>
                </h1>
                <p class="text-gray-500 text-[1rem]">Enter your portfolio projects here</p>
            </hgroup>
            <hr class="border border-gray-200 mb-2">
            <div class="inputs flex flex-col gap-3">
                <div class="image-uploads">
                    <p class="my-2 text-2xl">Media</p>
                    <div
                        class="bg-gray-200 shadow-md shadow-black/20 mt-2 border border-gray-400 rounded p-3 pb-3 box-border">
                        <div
                            class="images overflow-x-scroll flex gap-3 h-[120px] mb-2 bg-white rounded box-border p-2 px-3">
                            @foreach($project['media'] as $key => $media)
                            <div class="flex gap-2">
                                <div
                                    class="h-full w-[120px] min-w-[120px] border border-gray-400 bg-gray-100 flex items-center justify-center">
                                    @if(gettype($media) == 'object')
                                    <img class="max-w-[80%] max-h-full" src="{{ $media->temporaryUrl() }}">
                                    @else
                                    <img class="max-w-[80%] max-h-full" src="{{ $media }}">
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    @if(gettype($media) == 'object')
                                    <i x-on:click="$wire.deleteImage('local',{{ $key }},null)"
                                        class="bi bi-trash cursor-pointer hover:opacity-50 bg-red-50 text-red-500 border border-red-500 w-[30px] h-[30px] flex items-center justify-center">
                                    </i>
                                    @else
                                    <i x-on:click="deleteImageServer({{ $key }})"
                                        class="bi bi-trash cursor-pointer hover:opacity-50 bg-red-50 text-red-500 border border-red-500 w-[30px] h-[30px] flex items-center justify-center">
                                    </i>
                                    @endif
                                    <i x-on:click="$wire.editImages('move',{{ $key }},{{ $key + 1 }})"
                                        class="bi bi-arrow-right border cursor-pointer hover:opacity-50 border-gray-4000 w-[30px] h-[30px] flex items-center justify-center">
                                    </i>
                                    <i x-on:click="$wire.editImages('move',{{ $key }},{{ $key - 1 }})"
                                        class="bi bi-arrow-left border cursor-pointer hover:opacity-50 border-gray-4000 w-[30px] h-[30px] flex items-center justify-center">
                                    </i>
                                    <i x-on:click="$wire.editImages('cover',{{ $key }},null)"
                                        class="bi bi bi-image {{ gettype($project['cover']) == 'string' ? ($project['cover'] === $media ? 'bg-blue-50 text-blue-500 border-blue-500' : null) : ($project['cover'] === $key ? 'bg-blue-50 text-blue-500 border-blue-500' : null) }} border cursor-pointer hover:opacity-50 border-gray-4000 w-[30px] h-[30px] flex items-center justify-center">
                                    </i>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <label for="supporting-media-upload"
                            class="flex w-full flex gap-3 cursor-pointer hover:opacity-50 border border-gray-400 py-2 items-center justify-center bg-white rounded">
                            <i class="bi bi-upload"></i> Upload
                        </label>
                        <input wire:model='media' hidden multiple type="file" name="supporting-media-upload"
                            id="supporting-media-upload">
                    </div>
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Cover</label>
                    <p class="break-all" x-text="work.cover"></p>
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Name</label>
                    <input x-model="work.name" type="text" class="py-2 px-3 border border-gray-300" placeholder="Name">
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Name</label>
                    <select x-model="work.type" class="py-2 px-2 border border-gray-300">
                        <option value="digital">Digital</option>
                        <option value="web">Web</option>
                    </select>
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Tag <span x-text="tag_text"></span></label>
                    <div class="flex items-center flex-wrap gap-2 mb-3">
                        <p class="text-gray-300">Tags: </p>
                        <template x-for="(tag, tag_index) in work.tags" :key="tag_index">
                            <p
                                class="px-3 select-none flex items-center gap-3 pr-1 py-1 bg-gray-50 border border-gray-400 shadow-md shadow-black/30 rounded-4xl">
                                <span x-text="tag"></span><i x-on:click="removeTag(tag_index)"
                                    class="bi bi-x w-[20px] h-[20px] cursor-pointer active:opacity-50 hover:opacity-50 rounded-4xl flex items-center justify-center border border-red-400 bg-red-50 text-red-500"></i>
                            </p>
                        </template>
                    </div>
                    <input x-on:keydown.enter="addTag()" x-model="tag_text" type="text"
                        class="py-2 px-3 border border-gray-300" placeholder="Tag">
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Turnaround</label>
                    <input x-model="work.turnaround" type="text" class="py-2 px-3 border border-gray-300"
                        placeholder="Turnaround">
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Problem</label>
                    <textarea x-model="work.problem" type="text" class="py-2 px-3 border border-gray-300"
                        placeholder="Problem"></textarea>
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Explanation</label>
                    <textarea x-model="work.explanation" type="text" class="py-2 px-3 border border-gray-300"
                        placeholder="Explanation"></textarea>
                </div>
                @if($errors->any())
                <div class="errors flex my-3 flex-wrap gap-1">
                    @foreach($errors->all() as $key => $error)
                    <p class="text-red-500 border border-red-500 px-3 py-1 bg-red-50 rounded-4xl">{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <button x-on:click="$wire.saveProject()"
                    class="text-white cursor-pointer active:opacity-50 mt-2 bg-black px-5 py-2 rounded-4xl shadow-lg shadow-black/50">Save</button>
            </div>
        </div>
    </section>
</main>