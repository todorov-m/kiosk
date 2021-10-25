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
    <div class="col-md-12">
        <a role="button" class="btn btn-success pt-3 pb-3 total-size ml-4 mt-10" href="/newsales" onclick="event.preventDefault();
                                                     document.getElementById('saleSave').submit();">ЗАПИС & Нов</a>
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
        <a role="button" class="btn btn-danger pt-3 pb-3 total-size ml-4 mt-10" href="/sale" >ОТКАЗ & Нов</a>

    </div>


</div>
