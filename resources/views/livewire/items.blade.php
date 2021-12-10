<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm mt-3">
        <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Артикули</h4>
        </div>
        <div class="card-body">
            <div class="col-md">
                <form action="/items" method="Post" >
                    @csrf
                    <div class="form-row">
                        <x-form.input name="ean" class="form-group col-md-2" type="text" title="Баркод" />
                        <x-form.input name="name" class="form-group col-md-4" type="text" title="Име" />
                        <x-form.input name="delivery_price" class="form-group col-sm-1" type="text" title="Дост. Цена" />
                        <x-form.input name="sale_price" class="form-group col-sm-1" type="text" title="Прод. цена" />
                        <div class="form-group col-md-1">
                            <label for="inputState">Мярка</label>
                            <select class="form-control" name="packing" id="inputState">
                                <option value="1" selected>Брой</option>
                                <option value="2">Килограм</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputState">Данък</label>
                            <select class="form-control" name="tax" id="inputState">
                                <option value="7" selected>7%</option>
                                <option value="19">19%</option>
                            </select>
                        </div>
                    </div>
                     <button class="w-25 btn btn-primary btn-lg mt-4" type="submit">Добави</button>

                </form>
            </div>
            <div class="col-md mt-4">
                <livewire:items :userlevel="auth()->user()->level" searchable="name, ean" per-page="50" exportable />

            </div>
        </div>
    </div>
</x-layout>
