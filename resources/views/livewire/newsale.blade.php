<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm mt-3">
        <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Продажба {{ $salesId }}  </h4>
    @if ($message == '3')
            <iframe onload="isLoaded()" id="pdf" name="pdf" src="/receipt/receipt_{{ $oldsalesId }}.pdf" style="position: absolute;width:0;height:0;border:0;"></iframe>
    @endif
        </div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <form action="/newsales" method="POST" >
                    @csrf
                    <input type="hidden" name="salesId" value="{{ $salesId }}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-row">
                    <x-form.autofocus name="ean" class="form-group col-md-6" type="text" title="Баркод" />

                    <x-form.input name="quantity" class="form-group col-md-2" type="text" value="1" title="Кол." />
                        <div class="col-md-3 mb-3">
                    <button id="sbutton" class="btn btn-primary mt-7" type="submit">Добави</button>
                        </div>
                    </div>
                    @if ($message == '0')
                        <div class="form-row">
                            <div class="alert alert-danger" role="alert">
                                Грешен или липсващ баркод!!!
                            </div>
                        </div>
                       @endif



                </form>
            </div>
            <div class="row">
                <div class="col-9"><livewire:newsale :salesId="$salesId" /></div>
                <div class="col-3"><livewire:newsale-total :salesId="$salesId" /></div>
            </div>

           </div>
    </div>
</x-layout>
