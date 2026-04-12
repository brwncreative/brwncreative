<?php

use Livewire\Component;
use App\Jobs\MailMan;
use Livewire\Attributes\Computed;

new class extends Component
{
    public $payload = [
        'recipients' => [],
        'subject' => null,
        'body' => null,
    ], $message = null;

    #[Computed()]
    public function mailing()
    {
        return file_get_contents(resource_path('mailing.json'));
    }
    public function syncList($list)
    {
        file_put_contents(resource_path('mailing.json'), json_encode(array_values($list), JSON_UNESCAPED_SLASHES), LOCK_EX);
        $this->js('window.location.reload()');
    }
    public function send()
    {
        $this->message = null;
        $this->validate([
            'payload.recipients' => 'array|min:1',
            'payload.recipients.*' => 'email',
            'payload.subject' => 'required|min:1',
            'payload.body' => 'required|min:2'
        ]);
        foreach ($this->payload['recipients'] as $key => $recipient) {
            MailMan::dispatch(
                what: 'message',
                payload: [
                    'recipient' => $recipient,
                    'subject' => $this->payload['subject'],
                    'body' => $this->payload['body']
                ]
            );
        }
        $this->payload['recipients'] = [];
        $this->payload['subject'] = null;
        $this->payload['body'] = null;

        $this->message = 'Your messages have been qeued!';
    }
};
?>
@placeholder
<main>

</main>
@endplaceholder

<main id="mail-management" class="px-5" x-data="{
 letter: $wire.entangle('payload'),
 mailinglist: {{ $this->mailing }},
 checklist: false,
 mlrecipient: null,
 recipient: null,
 quill: null,
addML(){
    if(this.mlrecipient.length > 0){
    this.mailinglist.push(this.mlrecipient);
    }
    $wire.syncList(this.mailinglist);
},
delML(key){
 this.mailinglist.splice(key,1);
 $wire.syncList(this.mailinglist);
},
 addRec(){
 if(this.recipient.length > 0){
    this.letter.recipients.push(this.recipient);
    this.recipient = null;
 }
},
delRec(key){
 this.letter.recipients.splice(key,1)
},
seal(){
if(this.quill != null){
    if(this.quill.getLength() > 0){
    this.letter.body = this.quill.getSemanticHTML();
    }
    $wire.send();
}
},
init(){
  const qlink = document.createElement('link');
  qlink.rel = 'stylesheet';
  qlink.href = `https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css`;
  const qscript = document.createElement('script');
  qscript.src = `https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js`;

  document.head.append(qlink);
    document.head.append(qscript);

   window.setInterval(()=>{
   if(this.quill == null){
   this.quill = new Quill('#editor',{theme: 'snow',modules:{
   toolbar:{
   container:'#toolbar',
        }
    }
   }
   )
   }
   },500);
}
}">
    {{-- Introduction --}}
    <hgroup>
        <h1 class="text-3xl gap-3 flex items-center font-medium">Mail Center
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
        </h1>
        <p class="text-gray-500 text-[1rem]">Distribute mails here</p>
    </hgroup>
    {{-- Mailing List --}}
    <div class="mailing-list-management mt-2">
        <button class="border flex gap-5 items-center border-brwn shadow-md px-3 pr-1 py-1 rounded text-[1.2rem]">
            <p>Mailing List</p>
            <div class="actions flex items-center gap-1">
                <i x-on:click="checklist = !checklist"
                    class="bi bi-chevron-down cursor-pointer active:scale-95 flex w-[20px] h-[20px] text-sm bg-brwn text-white rounded shadow-lg items-center justify-center"></i>
                <p x-on:click="letter.recipients = letter.recipients.concat(mailinglist)" class=" bg-brwn cursor-pointer active:scale-95 text-sm px-3 py-1 text-white rounded shadow-lg items-center justify-center">Send All</p>
            </div>
        </button>
        {{-- List --}}
        <template x-if="checklist">
            <div class="bg-gray-100 mt-3 p-3 box-border">
                <div class="add-to-list mb-3 w-full flex">
                    <input x-on:keydown.enter="addML" x-on:keydown.space="addML" x-model="mlrecipient" type="text"
                        size="1" class="py-1 px-3 bg-white w-full border border-gray-400 outline-0"
                        placeholder="New Email">
                </div>
                <div class="flex flex-wrap gap-1 mt-2 max-h-[400px] overflow-y-auto">
                    <template x-for="(email,email_index) in mailinglist" :key="email_index">
                        <div
                            class="flex items-center shadow-md shadow-black/20 h-max border border-gray-400 gap-3 border bg-gray-100 px-2 pl-4 pr-1 py-1 rounded-4xl">
                            <p x-text="email"></p><i
                                x-on:click="confirm('Are you sure want to delete this recipient') ? delML(email_index) : null"
                                class="bi bi-x flex w-[15px] h-[15px] bg-gray-300 cursor-pointer active:opacity-50 border border-gray-400 shadow-md rounded-4xl items-center justify-center"></i>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>
    <hr class="border border-gray-200 my-2 mb-4">
    {{-- Mail Inputs --}}
    <div class="input-container flex items-center">
        <div class="inputs w-[800px] p-3 border border-gray-400 max-sm:w-full flex flex-col gap-3">
            <div class="input flex flex-col gap-2">
                <label for="recipients">
                    Recipients
                </label>
                <div class="recipients flex flex-wrap gap-1 max-h-[400px] overflow-y-auto">
                    <template x-for="(recipient,recipient_index) in letter.recipients" :key="recipient_index">
                        <div
                            class="flex items-center border h-max border-gray-400 gap-3 border bg-gray-100 px-2 pl-4 pr-1 py-1 rounded-4xl">
                            <p x-text="recipient"></p><i x-on:click="delRec(recipient_index)"
                                class="bi bi-x flex w-[15px] h-[15px] bg-gray-300 cursor-pointer active:opacity-50 border border-gray-400 shadow-md rounded-4xl items-center justify-center"></i>
                        </div>
                    </template>
                </div>
                <input x-on:keydown.enter="addRec" x-on:keydown.space="addRec" x-model="recipient" type="text"
                    placeholder="Email" class="px-3 py-2 outline-0 border border-gray-400">
            </div>
            <div class="subject input flex flex-col gap-2">
                <label for="subject">
                    Subject
                </label>
                <input x-model="letter.subject" type="text" placeholder="Subject"
                    class="px-3 py-2 outline-0 border border-gray-400">
            </div>
            <div class="body input flex flex-col gap-2">
                <label for="body">
                    Body
                </label>
                {{-- Quill Editor --}}
                <div wire:ignore id="toolbar">
                    <span class="ql-formats">
                        <select class="ql-font"></select>
                        <select class="ql-size"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                        <button class="ql-strike"></button>
                    </span>
                    <span class="ql-formats">
                        <select class="ql-color"></select>
                        <select class="ql-background"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-script" value="sub"></button>
                        <button class="ql-script" value="super"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-header" value="1"></button>
                        <button class="ql-header" value="2"></button>
                        <button class="ql-blockquote"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                        <button class="ql-indent" value="-1"></button>
                        <button class="ql-indent" value="+1"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-direction" value="rtl"></button>
                        <select class="ql-align"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-link"></button>
                        <button class="ql-image"></button>
                    </span>
                </div>
                <div wire:ignore id="editor">
                </div>
                @if($errors->any())
                <div class="errors flex my-3 flex-wrap gap-1">
                    @foreach($errors->all() as $key => $error)
                    <p class="text-red-500 border border-red-500 px-3 py-1 bg-red-50 rounded-4xl">{{
                        str_replace('payload.','',$error) }}</p>
                    @endforeach
                </div>
                @endif
                <button x-on:click="seal"
                    class="py-3 px-5 bg-black text-white mt-3 cursor-pointer active:opacity-50">Send</button>
                @if($message)
                <div class="message border-l-3 border-l-green-800 mt-3 bg-gray-50 py-2 px-3">
                    {{$message}}
                </div>
                @endif
            </div>
        </div>
    </div>
</main>