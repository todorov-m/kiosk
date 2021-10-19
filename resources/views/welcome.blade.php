<x-layout>
    @auth
        <div class="bg-light p-5 rounded">
            <h1>{{auth()->user()->username}}</h1>

        </div>


    @else
        <div class="row justify-content-center mt-4">
            <div class="card" style="width: 30rem;">
                <form class="needs-validation" method="POST" action="/login">
                    @csrf

                    <div class="card-body">
                            <x-form.input name="username" class="mb-3" type="text" title="Потребителско име" />
                            <x-form.input name="password" class="mb-3" type="password" title="Парола" />
                            <div class="row justify-content-center mt-4">
                            <button class="w-50 btn btn-primary btn-lg" type="submit">Вход</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    @endauth

</x-layout>
