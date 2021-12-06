<div class="row justify-content-md-center">

     <div class="col-md-12">
         <div class="h1 total-label">№ {{ $salesId }}  Тотал</div>
         <div class="h1 total-label alert alert-success ml-auto mr-auto pt-3 pb-3"> {{ $total }} </div>
        </div>


        <div class="col-md-12">
            <div class="h1 total-label">Платено</div>
            @if($head->status == 1)
                <div class="h1 total-label alert alert-secondary ml-auto mr-auto pt-3 pb-3"> {{ $head->payd }} </div>
@else
                <a role="button" class="btn btn-outline-secondary btn-lg btn-block pt-2 pb-2 total-size" data-toggle="modal" data-target="#payment"  data-keyboard="false" id="PrintSale">{{ $head->payd }}</a>
@endif

            <!-- Modal Receipt-->
            <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                            <form action="/custompayd" method="POST" name="vform">
                                <input id="payd" type="text" name="payd"  value="{{ $head->payd }}" onfocus="this.value=''" class="h-20 form-control ml-auto mr-auto total-size"/>
                                <input type="hidden" name="salesId" value="{{ $salesId }}">
                                @csrf
                                <br />
                                <div class="row justify-content-md-center">
                                    <div class="col col-lg-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="1" value="1" id="1" onClick=addNumber(this); />
                                    </div>
                                    <div class="col col-lg-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="2" value="2" id="2" onClick=addNumber(this); />
                                    </div>
                                    <div class="col col-lg-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="3" value="3" id="3" onClick=addNumber(this); />
                                    </div>
                                </div>
                                <div class="row justify-content-md-center mt-2">
                                    <div class="col col-lg-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="4" value="4" id="4" onClick=addNumber(this); />
                                    </div>
                                    <div class="col col-lg-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="5" value="5" id="5" onClick=addNumber(this); />
                                    </div>
                                    <div class="col col-lg-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="6" value="6" id="6" onClick=addNumber(this); />
                                    </div>
                                </div>
                                <div class="row justify-content-md-center mt-2">
                                    <div class="col col-lg-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="7" value="7" id="7" onClick=addNumber(this); />
                                    </div>
                                    <div class="col col-lg-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="8" value="8" id="8" onClick=addNumber(this); />
                                    </div>
                                    <div class="col col-lg-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="9" value="9" id="9" onClick=addNumber(this); />
                                    </div>
                                </div>
                                <div class="row justify-content-md-center mt-2">
                                    <div class="col-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="0" value="0" id="0" onClick=addNumber(this); />
                                    </div>
                                    <div class="col-3">
                                        <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="." value="." id="." onClick=addNumber(this); />
                                    </div>

                                </div>
                                <div class="row justify-content-md-center mt-2">
                                    <div class="col-6"><button type="submit" class="btn btn-primary btn-block total-size">ЗАПИС</button></div>
                                    <div class="col-4"><button type="button" class="btn btn-outline-danger btn-block total-size" onclick="ClearCustomPay();">Clear</button></div>
                                </div>
                            </form>
                            <script type="text/javascript">
                                function addNumber(element){
                                    document.getElementById('payd').value = document.getElementById('payd').value+element.value;
                                }
                                function ClearCustomPay() {

                                    document.getElementById("payd").value = "";

                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>

    </div>



        <div class="col-md-12">
            <div class="h1 total-label">Ресто</div>
            <div class="h1 total-label alert alert-info ml-auto mr-auto pt-3 pb-3"> {{ $head->resto }} </div>
        </div>
    @if($status == 0)
    <div class="col-md-12">
        <a role="button" class="btn btn-success btn-lg btn-block pt-4 pb-4 total-size" href="/newsales" id="SaveSale" onclick="event.preventDefault();
                                                     document.getElementById('saleSave').submit();">ЗАПИС</a>
        <form id="saleSave" action="/newsales" method="POST"
              style="display: none;">
            <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
            <input type="hidden" name="total" value="0">
            <input type="hidden" name="status" value="0">
            <input type="hidden" name="salesId" value="{{ $salesId }}">
            <input type="hidden" name="saldos_id" value="{{$head->saldos_id}}">
            @csrf
        </form>

    </div>

        <div class="col-md-12">
            <a role="button" class="btn btn-danger btn-lg btn-block pt-4 pb-4 total-size mt-3" href="/clearsale/{{ $salesId }}" id="CloseSale" > ОТКАЗ </a>

        </div>
    @else
        <div class="col-md-12">
            <a role="button" class="btn btn-primary btn-lg btn-block pt-4 pb-4 total-size" data-toggle="modal" data-target="#receiptPrint" data-backdrop="static" data-keyboard="false" id="PrintSale"> ПРИНТ </a>
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
                        <div class="d-flex justify-content-center">
                            <button id="btnPrint" class="hidden-print btn btn-primary btn-lg pl-5 pr-5" data-dismiss="modal">Print</button>
                        </div>
                        <div id="printThis">
                        @include('sales.receipt')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <a role="button" class="btn btn-success btn-lg btn-block pt-4 pb-4 total-size mt-3" href="/newsales" onclick="event.preventDefault();
                                                     document.getElementById('new-sale').submit();">НОВА</a>
            <form id="new-sale" action="/newsales" method="POST"
                  style="display: none;">
                <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="total" value="0">
                <input type="hidden" name="status" value="0">
                <input type="hidden" name="salesId" value="0">
                <input type="hidden" name="saldos_id" value="{{$head->saldos_id}}">
                @csrf
            </form>
        </div>

    @endif




</div>
