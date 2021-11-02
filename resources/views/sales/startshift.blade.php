<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm mt-3">
        <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Начало на смяна </h4>

        </div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <form action="/shiftstart" method="POST" >
                    @csrf
                    <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                             <div class="form-row">
                        <x-form.autofocus name="shiftstart_sum" class="form-group col-md-6" inputClass="h-20 form-control ml-auto mr-auto total-size" labelClass="form-label h2" type="text" title="Начално салдо" value="0" />
                             </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <button id="sbutton" class="btn btn-primary pl-5 pt-3 pb-3 pr-5 total-size ml-2 mr-2" type="submit">СТАРТ</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


</x-layout>
