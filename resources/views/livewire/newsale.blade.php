<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-body">

            <div class="row">
                <div class="col-9">
                    <div class="row">
                        <div class="col-lg-9">
                            <livewire:search :salesId="$salesId" :status="$status" :mesage="$message" :quantity="1"/>
                            @isset($items)
                                <div class="row justify-content-md-center">
                                    <div class="col-md-auto w-75">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action list-group-item-danger text-body">Намерени са няколко артикула с този БАРКОД! Изберете правилния от списъка!</a>
                                            @foreach($items as $item)
                                                <a href="/additem?id={{ $item->id }}&quantity={{$quantity}}&salesId={{$salesId}}" class="list-group-item list-group-item-action"> {{ $item->name }} - {{ $item->ean }} - {{ $item->sale_price }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        </div>

                        <div class="col-lg-3">
                            <div class="simple-keyboard"></div>
                            <script src="{{ asset('js/kiosk_kb.js') }}" ></script>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                      <livewire:newsale :salesId="$salesId" :userlevel="auth()->user()->level" />
                    </div>
                    </div>
                </div>
                <div class="col-3">

                    <livewire:newsale-total :salesId="$salesId"/>
                </div>
            </div>


        </div>
    </div>
</x-layout>
