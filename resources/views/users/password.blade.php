<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm mt-3">
        <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Промяна на парола</h4>
        </div>
        <div class="card-body">
            <div class="col-md-7">
                <form action="/changepass/{{$user->id}}" method="Post">
                    @csrf
                    @method('PATCH')
                    <div class="form-row">
                        <x-form.input name="name" class="form-group col-md-8" type="text" value="{{$user->name}}"  readonly title="Две имена" />
                    </div>
                    <div class="form-row">
                        <x-form.input name="username" class="form-group" type="text" value="{{$user->username}}" readonly title="Потребител /User/" />
                    </div>
                    <div class="form-row">
                        <x-form.input name="password" class="form-group" type="password" title="Нова парола" />
                    </div>
                    <hr class="my-4">
                    <button class="w-25 btn btn-primary btn-lg" type="submit">Запис</button>

                </form>
            </div>
        </div>
    </div>
</x-layout>
