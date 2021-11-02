<style>
    @page {
        size: 223pt auto;
    }
    .receipt {
        font-size: 10px;
    }

</style>
   @foreach($tax7 as $item7)
   <p class="receipt text-success"> {{$item7->ean}} - {{$item7->quantity}} - {{$item7->name}} </p>

    @endforeach
<hr/>
@foreach($tax19 as $item19)
    <p class="receipt text-success"> {{$item19->ean}} - {{$item19->quantity}} - {{$item19->name}} </p>

@endforeach


