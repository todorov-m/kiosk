<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm">
        @if(Request::is('newsales/*') AND auth()->user()->level > 90)
        <div class="card-header py-3">
            <div class="row">


                    <div class="col">
                        <a type="button" class="btn btn-outline-primary" href="/listsales"><< На зад</a>
                    </div>


                <div class="col">
                    <div class="d-flex justify-content-center">  <h4 class="my-0 fw-normal"> Продажба {{ $salesId }} </h4></div>
                </div>
            </div>


        </div>
        @endif
        <div class="card-body">

            <div class="row">
                <div class="col-9">
                    @if($status == 0)
                    <div class="row justify-content-md-center">
                        <form action="/newsales" method="POST" >
                            @csrf
                            <input type="hidden" name="salesId" value="{{ $salesId }}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-row">
                                <x-form.autofocus name="ean" class="form-group col-md-6" inputClass="form-control form-ean form-control-lg" labelClass="form-label" type="text" title="Баркод" />

                                <x-form.input name="quantity" class="form-group col-md-2" type="text" value="1" title="Кол." data-toggle="modal" data-target="#quantityModal"/>
                                <div class="col-md-3 mb-3">
                                    <button id="sbutton" class="btn btn-primary mt-7 btn-lg" type="submit">Добави</button>
                                </div>

                            </div>
                            @if ($message == '0')
                                <div class="form-row">
                                    <div class="alert alert-danger" role="alert">
                                        Грешен или липсващ баркод!!!
                                    </div>
                                </div>
                            @endif
                        <!-- Modal Receipt-->
                            <div class="modal fade" id="quantityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <br />
                                            <div class="row justify-content-md-center">
                                                <div class="col">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="1" value="1" id="1" onClick=addNumberQ(this); />
                                                </div>
                                                <div class="col">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="2" value="2" id="2" onClick=addNumberQ(this); />
                                                </div>
                                                <div class="col">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="3" value="3" id="3" onClick=addNumberQ(this); />
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center mt-2">
                                                <div class="col">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="4" value="4" id="4" onClick=addNumberQ(this); />
                                                </div>
                                                <div class="col">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="5" value="5" id="5" onClick=addNumberQ(this); />
                                                </div>
                                                <div class="col">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="6" value="6" id="6" onClick=addNumberQ(this); />
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center mt-2">
                                                <div class="col">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="7" value="7" id="7" onClick=addNumberQ(this); />
                                                </div>
                                                <div class="col">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="8" value="8" id="8" onClick=addNumberQ(this); />
                                                </div>
                                                <div class="col">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="9" value="9" id="9" onClick=addNumberQ(this); />
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center mt-2">
                                                <div class="col">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="0" value="0" id="0" onClick=addNumberQ(this); />
                                                </div>
                                                <div class="col-md-auto">
                                                    <input type="button" class="btn btn-lg btn-outline-info btn-block total-size" name="." value="." id="." onClick=addNumberQ(this); />
                                                </div>
                                                <div class="col">
                                                    <button type="button" class="btn btn-outline-danger btn-block total-size" onclick="ClearFields();">Clear</button>
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center mt-2">
                                                <div class="col">
                                                    <button type="button" class="btn btn-primary btn-block total-size" data-dismiss="modal" onclick="focusEAN();">ЗАПИС</button>
                                                </div>

                                            </div>

                                            <script type="text/javascript">
                                                function addNumberQ(element){
                                                    document.getElementById('quantity').value = document.getElementById('quantity').value+element.value;
                                                }
                                                function ClearFields() {
                                                    document.getElementById("quantity").value = "";
                                                }
                                                function focusEAN() {
                                                    document.getElementById("ean").focus();
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Modal Receipt-->

                        </form>

                    </div>
                    @endif


                    <livewire:newsale :salesId="$salesId" :userlevel="auth()->user()->level" />

                </div>
                <div class="col-3">

                    <livewire:newsale-total :salesId="$salesId"/>
                </div>
            </div>

           </div>
    </div>
</x-layout>
