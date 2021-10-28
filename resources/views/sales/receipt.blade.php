<style>
    @page {
        size: 223pt auto;
    }
    .receipt {
        font-size: 10px;
    }

</style>
   @foreach($items as $item)
   <p class="receipt text-success"> {{$item->ean}} - {{$item->quantity}} - {{$item->name}} </p>

    @endforeach


