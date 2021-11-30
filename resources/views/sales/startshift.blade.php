<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm mt-3">
        <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Начало на смяна</h4>

        </div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <form action="/shiftstart" method="POST" >
                    @csrf
                    <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
                             <div class="form-row">
                        <x-form.autofocus name="shiftstart_sum" class="form-group col-md-6" inputClass="h-20 form-control ml-auto mr-auto total-size" labelClass="form-label h2" type="text" title="Начално салдо" value="0" data-toggle="modal" data-target="#quantityModal"/>
                             </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <button id="sbutton" class="btn btn-primary pl-5 pt-3 pb-3 pr-5 total-size ml-2 mr-2" type="submit">СТАРТ</button>
                        </div>
                    </div>
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
                                            document.getElementById('shiftstart_sum').value = document.getElementById('shiftstart_sum').value+element.value;
                                        }
                                        function ClearFields() {
                                            document.getElementById("shiftstart_sum").value = "";
                                        }
                                        function focusEAN() {
                                            document.getElementById("shiftstart_sum").focus();
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Modal Receipt-->





                </form>
            </div>
        </div>


</x-layout>
