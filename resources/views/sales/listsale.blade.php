<x-layout>
    <div class="card mb-4 rounded-3 shadow-sm mt-3">
        <div class="card-header py-3">22
            @foreach($contents as $item)
                1-   {{$item->ean}}
            @endforeach
        </div>

    </div>
</x-layout>
