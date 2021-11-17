<div class="row justify-content-md-center">

     <div class="col-md-12">
         <div class="h1 total-label">Тотал</div>
         <div class="h1 total-label alert alert-success ml-auto mr-auto pt-3 pb-3"> {{ $total }} </div>
        </div>


        <div class="col-md-12">
            <div class="h1 total-label">Платено</div>
        <input wire:model="payd" id="payd" type="text" class="h-20 form-control ml-auto mr-auto total-size">
    </div>



        <div class="col-md-12">
            <div class="h1 total-label">Ресто</div>
            <div class="h1 total-label alert alert-info ml-auto mr-auto pt-3 pb-3"> {{ $resto }} </div>
        </div>
    @if($status == 0)
    <div class="col-md-12">
        <a role="button" class="btn btn-success pt-3 pb-3 total-size ml-4 mt-10 w-80" href="/newsales" id="SaveSale" onclick="event.preventDefault();
                                                     document.getElementById('saleSave').submit();">>>ЗАПИС<<</a>
        <form id="saleSave" action="/newsales" method="POST"
              style="display: none;">
            <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
            <input type="hidden" name="total" value="0">
            <input type="hidden" name="status" value="0">
            <input type="hidden" name="salesId" value="{{ $salesId }}">
            <input type="hidden" name="payd" value="{{ $payd }} ">
            @csrf
        </form>

    </div>

        <div class="col-md-12">
            <a role="button" class="btn btn-danger pt-3 pb-3 total-size ml-4 mt-10" href="/clearsale/{{ $salesId }}" id="CloseSale" > >>ОТКАЗ<< </a>

        </div>
    @else
        <div class="col-md-12">
            <a role="button" class="btn btn-primary pt-3 pb-3 total-size ml-4 mt-10" data-toggle="modal" data-target="#receiptPrint" data-backdrop="static" data-keyboard="false" id="PrintSale"> >>ПРИНТ<< </a>
        </div>

        <!-- Modal Receipt-->
        <div class="modal fade" id="receiptPrint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex" id="exampleModalLabel">ПРОДАЖБА № {{ $salesId }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('sales.receipt')
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <a role="button" class="btn btn-success pt-3 pb-3 total-size ml-4 mt-10" href="/newsales" onclick="event.preventDefault();
                                                     document.getElementById('new-sale').submit();">>>НОВА<<</a>
            <form id="new-sale" action="/newsales" method="POST"
                  style="display: none;">
                <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="total" value="0">
                <input type="hidden" name="status" value="0">
                <input type="hidden" name="salesId" value="0">
                @csrf
            </form>
        </div>

    @endif




</div>
