
    @if($status == 0 OR auth()->user()->level >90)
        <div class="row justify-content-md-center">
            <form wire:submit.prevent="submit" >
                @csrf
                <input type="hidden" name="salesId" value="{{ $salesId }}">
                <input type="hidden" name="_method" value="PUT">
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="ean" class="form-label">Баркод/Име</label>
                        <input class="form-control form-ean form-control-lg" wire:model.debounce.600ms="ean" id="ean" type="text" required="" autofocus="">

                    </div>
                    <div class="form-group col-md-2">
                        <label for="quantity" class="form-label">Кол.</label>
                        <input class="form-control form-control-lg" wire:model="quantity" id="quantity" type="text" required="" data-toggle="modal" data-target="#quantityModal">

                    </div>

                    <div class="col-md-3 mb-3">
                        <button id="sbutton" class="btn btn-primary mt-7 btn-lg" type="submit" @isset($save) {{$save}} @endisset>Добави</button>
                    </div>

                </div>
                @error('ean') <div class="p-3 mb-2 bg-danger text-white">Не е намерен БАРКОД!!!</div> @enderror
                @error('quantity') <div class="p-3 mb-2 bg-danger text-white">Продава се на ТЕГЛО! Въведете количество в този вид <p class="h3">0.000</p></div> @enderror


                @isset($posts)

                    <div class="list-group">
                @foreach($posts as $post)
                        <a href="/additem?id={{ $post->id }}&quantity={{$quantity}}&salesId={{$salesId}}" class="list-group-item list-group-item-action"> {{ $post->name }} - {{ $post->ean }} - {{ $post->sale_price }}</a>
                @endforeach
                    </div>
            @endisset

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
                                        document.getElementById("quantity").dispatchEvent(new Event('input'));
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
