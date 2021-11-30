<x-layout>
<div class="card mb-4 rounded-3 shadow-sm mt-3">
    <div class="card-header py-3">
        <h4 class="my-0 fw-normal">Генериране на дневен отчет</h4>

    </div>
    <div class="card-body">
        <div class="row justify-content-md-center">
            <form action="/dailyclose" method="POST" >
                @csrf
                <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                <div class="form-row">
                    <x-form.input name="salesDate" class="form-group col-md-12" inputClass="h-20 form-control ml-auto mr-auto total-size" labelClass="form-label h2" type="date" title="Дневен отчет за" value="0"/>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <button id="sbutton" class="btn btn-primary pl-5 pt-3 pb-3 pr-5 total-size ml-2 mr-2" type="submit">ГЕНЕРИРАЙ</button>
                    </div>
                </div>
                @if(isset($status))


                    <div class="col-md-12">
                        <a role="button" class="btn btn-success btn-lg btn-block pt-4 pb-4 total-size" data-toggle="modal" data-target="#receiptPrint" data-backdrop="static" data-keyboard="false" id="PrintSale"> ПРИНТ </a>
                    </div>

                    <!-- Modal Receipt-->
                    <div class="modal fade" id="receiptPrint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title d-flex" id="exampleModalLabel">Дневе отчет за {{ $daily_close_date }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('sales.dailyreceipt')
                                </div>
                            </div>
                        </div>
                    </div>
@endif




            </form>
        </div>
    </div>


    </x-layout>
