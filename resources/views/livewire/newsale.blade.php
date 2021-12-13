<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-body">

            <div class="row">
                <div class="col-9">

                    <livewire:search :salesId="$salesId" :status="$status" :mesage="$message" :quantity="1"/>
                    @isset($items)
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto w-50">
                        <div class="list-group">
                            @foreach($items as $item)
                                <a href="/additem?id={{ $item->id }}&quantity={{$quantity}}&salesId={{$salesId}}" class="list-group-item list-group-item-action"> {{ $item->name }} - {{ $item->ean }} - {{ $item->sale_price }}</a>
                            @endforeach
                        </div>
                            </div>
                        </div>
                    @endisset
                    <livewire:newsale :salesId="$salesId" :userlevel="auth()->user()->level" />

                </div>
                <div class="col-3">

                    <livewire:newsale-total :salesId="$salesId"/>
                </div>
            </div>


           </div>
    </div>
</x-layout>
