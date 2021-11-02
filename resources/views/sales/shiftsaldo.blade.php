<x-layout>
    @if ($shiftstatus == '0')
      <div class="row mx-lg-n5 mt-10">
        <div class="col-sm">
            <div class="h1 total-label">Начално Салдо</div>
            <div class="h1 total-label alert alert-danger ml-auto mr-auto pt-3 pb-3"> {{ $shiftstart_sum }} </div>
        </div>
        <div class="col-sm">
            <div class="h1 total-label">Текущ оборот</div>
            <div class="h1 total-label alert alert-primary ml-auto mr-auto pt-3 pb-3">   {{ $shiftsale_sum }} </div>
        </div>
        <div class="col-sm">
            <div class="h1 total-label">Наличност Каса</div>
            <div class="h1 total-label alert alert-success ml-auto mr-auto pt-3 pb-3"> {{ $shiftstart_sum + $shiftsale_sum }} </div>
        </div>
    </div>
    @endif
        <div class="row">
            <div class="col">
                <div class="row justify-content-center mt-4">
                    <div class="card" style="width: 30rem;">
                        <a role="button" class="btn btn-success pt-5 pb-5 total-size" href="/newsales" onclick="event.preventDefault();
                                                     document.getElementById('new-sale').submit();">Нова Продажба</a>
                        <form id="new-sale" action="/newsales" method="POST"
                              style="display: none;">
                            <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                            <input type="hidden" name="total" value="0">
                            <input type="hidden" name="status" value="0">
                            <input type="hidden" name="salesId" value="0">
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row justify-content-center mt-4">
                    <div class="card" style="width: 30rem;">
                        <a role="button" class="btn btn-primary pt-5 pb-5 total-size" href="/shiftend" onclick="event.preventDefault();
                                                     document.getElementById('end-shift').submit();">Край на Смяна</a>
                        <form id="end-shift" action="/shiftend" method="POST"
                              style="display: none;">
                            @method('PUT')
                            <input type="hidden" name="shift_id" value="{{ $shift_id }}">
                            <input type="hidden" name="shiftsale_sum" value="{{ $shiftsale_sum }}">
                            <input type="hidden" name="shiftend_sum" value="{{ $shiftstart_sum + $shiftsale_sum }}">
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>



</x-layout>
