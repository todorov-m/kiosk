<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm mt-3">
        <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Списък Потребители</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 50px">#</th>
                        <th scope="col">Име</th>
                        <th scope="col">User</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td scope="row">{{$user->id}}</td>
                            <td><a href="/changepass/{{$user->id}}"> {{$user->name}}</a></td>
                            <td>{{$user->username}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

        </div>

    </div>
    </x-layout>
