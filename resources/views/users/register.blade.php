<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm mt-3">
        <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Добавяне на Потребител</h4>
        </div>
        <div class="card-body">
            <div class="col-md-7">
                <form action="/createuser" method="Post">
                    @csrf
                    <div class="form-row">
                        <x-form.input name="name" class="form-group col-md-8" type="text" title="Две имена" />
                    </div>
                    <div class="form-row">
                        <x-form.input name="username" class="form-group" type="text" title="Потребител /User/" />
                    </div>
                    <div class="form-row">
                        <x-form.input name="password" class="form-group" type="password" title="Парола /Pass/" />
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                        <label for="inputState">Ниво на потребител</label>
                        <select class="form-control" name="level" id="inputState">
                            <option value="1" selected>Потребител</option>
                            <option value="0">Администратор</option>
                         </select>
                        </div>
                    </div>
                    <hr class="my-4">
                        <button class="w-25 btn btn-primary btn-lg" type="submit">Запис</button>

                </form>
            </div>
        </div>
    </div>
</x-layout>
