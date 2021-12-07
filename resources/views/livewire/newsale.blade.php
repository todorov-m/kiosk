<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-body">

            <div class="row">
                <div class="col-9">
                    <livewire:search :salesId="$salesId" :status="$status" :mesage="$message" :quantity="1"/>

                    <livewire:newsale :salesId="$salesId" :userlevel="auth()->user()->level" />

                </div>
                <div class="col-3">

                    <livewire:newsale-total :salesId="$salesId"/>
                </div>
            </div>

           </div>
    </div>
</x-layout>
