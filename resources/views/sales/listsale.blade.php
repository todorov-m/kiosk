<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm mt-3">
        <div class="card-header py-3">
            <div class="d-flex flex-row bd-highlight">
                <div class="mr-5">Продажба №<b>{{ $heads ->id }}</b> /{{$heads->updated_at}}</div><div class="mr-5">Сума: <b>{{$heads->total}}</b></div>
                <div class="mr-7">Потребител: <b>{{ $heads->users->name }}</b></div>
                @if($heads->status == '1')<div class="text-success font-weight-bold"> Приключена</div>@endif
                @if($heads->status == '0')<div class="text-danger font-weight-bold"> Незавършена</div>@endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">EAN</th>
                        <th scope="col">Име</th>
                        <th scope="col">Tax</th>
                        <th scope="col">Кол.</th>
                        <th scope="col">ед. цена</th>
                        <th scope="col">тотал</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contents as $content)
                        <tr>
                            <td>{{$content->ean}}</td>
                            <td> {{$content->name}}</td>
                            <td>{{$content->tax}}</td>
                            <td>{{$content->quantity}}</td>
                            <td>{{$content->single_price}}</td>
                            <td>{{$content->linetotal}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</x-layout>
