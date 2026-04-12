<?php

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Jobs\MailMan;

new class extends Component
{
    public $clients, $client = [
        'id' => null,
        'name' => null,
        'description' => null,
        'address' => null,
        'balance' => null,
        'email' => null,
        'phone' => '1868'
    ];

    public function getClients()
    {
        $this->clients = DB::table('clients')->get()->chunk(5);
    }
    public function editClient($client)
    {
        $this->client = $client;
    }
    public function deleteClient($id)
    {
        DB::table('clients')->delete($id);
        if ($id == $this->client['id']) {
            self::freshClient();
        }
        self::getClients();
    }

    public function mail($id)
    {
        MailMan::dispatch(what: 'account-review', client: $id);
    }

    public function saveClient()
    {
        $this->validate([
            'client.name' => 'required',
            'client.description' => 'required',
            'client.balance' => 'required|numeric',
            'client.email' => 'required',
            'client.phone' => 'numeric'
        ]);

        $client = Client::updateOrcreate(['id' => $this->client['id']], [
            'name' => $this->client['name'],
            'description' => $this->client['description'],
            'address' => $this->client['address'],
            'balance' => $this->client['balance'],
            'email' => $this->client['email'],
            'phone' => $this->client['phone'],
        ]);

        if ($client->id) {
            self::getClients();
            self::freshClient();
        }
    }
    public function freshClient()
    {
        $this->client = ['id' => null, 'name' => null, 'description' => null, 'address' => null, 'balance' => null, 'email' => null, 'phone' => '1868'];
    }

    public function mount()
    {
        self::getClients();
    }
};
?>

<main id="clients-menu" class="px-5" x-data="{
    clients: $wire.entangle('clients'),
    client: $wire.entangle('client'),
    page: 0
}">
    <section id="client-container" class="grid grid-cols-2">
        <div class="db">
            <div
                class="w-full border border-gray-400 p-3 px-4 box-border flex flex-col gap-3 overflow-y-auto max-h-[500px] h-[500px]">
                <template x-if="clients.length > 0">
                    <template x-for="(customer, client_index) in clients[page]">
                        <div
                            class="w-full border-l-4 bg-gray-100 p-3 px-4 border border-brwn shadow-md shadow-black/20 box-border">
                            <hgroup>
                                <p class="font-medium" x-text="customer.name"></p>
                                <p class="line-clamp-1" x-text="customer.description"></p>
                                <p class="font-bold animate-pulse text-lg"
                                    x-text="`$`+ Number(customer.balance).toFixed(2)"></p>
                            </hgroup>
                            <div class="actions flex gap-2 justify-end mt-2">
                                <a href="">
                                    <i
                                        class="bi bi-whatsapp border hover:opacity-50 border-gray-400 cursor-pointer active:opacity-50 bg-white rounded-lg shadow-black/40 w-[35px] h-[35px] shadow-lg flex items-center justify-center"></i>
                                </a>
                                <i x-on:click="$wire.mail(customer.id)"
                                    class="bi bi-envelope border hover:opacity-50 border-gray-400 cursor-pointer active:opacity-50 bg-white rounded-lg shadow-black/40 w-[35px] h-[35px] shadow-lg flex items-center justify-center"></i>
                                <i x-on:click="$wire.editClient(customer)"
                                    class="bi bi-pencil border hover:opacity-50 border-gray-400 cursor-pointer active:opacity-50 bg-white rounded-lg shadow-black/40 w-[35px] h-[35px] shadow-lg flex items-center justify-center"></i>
                                <i x-on:click="confirm(`Are you sure you want to delete client: ${customer.name}`) ? $wire.deleteClient(customer.id) : null"
                                    class="bi bi-trash border hover:opacity-50 border-red-500 text-red-500 cursor-pointer active:opacity-50 bg-red-50 rounded-lg shadow-red-500/40 w-[35px] h-[35px] shadow-lg flex items-center justify-center"></i>
                            </div>
                        </div>
                    </template>
                </template>
                <template x-if="clients.length < 1">
                    <hgroup>
                        <p class="text-2xl max-w-[200px] capitalize text-gray-500 animate-pulse p-3 px-5">No clients
                            have
                            been added yet</p>
                    </hgroup>
                </template>
            </div>
        </div>
        <div class="form px-5">
            {{-- Greeting --}}
            <hgroup>
                <h1 class="text-3xl flex items-center gap-3">Client Management
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
                <p class="text-[1.1rem] text-gray-500">Manage your clients from this area</p>
            </hgroup>
            <hr class="my-2 border border-gray-200">
            {{-- Inputs --}}
            <div class="inputs flex flex-col gap-3">
                <div class="input flex flex-col gap-1">
                    <label>Name</label>
                    <input x-model="client.name" type="text" class="outline-0 border border-gray-300 px-3 py-2"
                        placeholder="John Doe">
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Address</label>
                    <input x-model="client.address" type="text" class="outline-0 border border-gray-300 px-3 py-2"
                        placeholder="Address">
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Description</label>
                    <textarea x-model="client.description" type="text"
                        class="outline-0 border border-gray-300 px-3 py-2" placeholder="Description"></textarea>
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Balance</label>
                    <input x-model="client.balance" type="number" class="outline-0 border border-gray-300 px-3 py-2"
                        placeholder="2000.00">
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Email</label>
                    <input x-model="client.email" type="text" class="outline-0 border border-gray-300 px-3 py-2"
                        placeholder="person@company.com">
                </div>
                <div class="input flex flex-col gap-1">
                    <label>Phone</label>
                    <input x-model="client.phone" type="text" class="outline-0 border border-gray-300 px-3 py-2"
                        placeholder="(---) --- ----">
                </div>
                @if($errors->any())
                <div class="errors flex my-3 flex-wrap gap-1">
                    @foreach($errors->all() as $key => $error)
                    <p class="text-red-500 border border-red-500 px-3 py-1 bg-red-50 rounded-4xl">{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <button x-on:click="$wire.saveClient()"
                    class="text-white cursor-pointer active:opacity-50 mt-2 bg-black px-5 py-2 rounded-4xl shadow-lg shadow-black/50">Save</button>
            </div>
        </div>
    </section>
</main>