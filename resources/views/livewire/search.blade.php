
@if($status == 0 OR auth()->user()->level >90)
      <form wire:submit.prevent="submit" >
            @csrf
            <input type="hidden" name="salesId" value="{{ $salesId }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="form-row">



                <div class="form-group col-md-7">
                    <label for="ean" class="form-label">Баркод/Име</label>
                    <input class="input form-control form-ean form-control-lg" wire:model.debounce.600ms="ean" id="ean" type="text" required="" autofocus="" >

                </div>




                <div class="form-group col-md-2">
                    <label for="quantity" class="form-label">Кол.</label>
                    <input class="input form-control form-control-lg" wire:model="quantity" id="quantity" type="text" required="" >

                </div>

                <div class="col-md-3 mb-3">
                    <button id="sbutton" class="btn btn-primary mt-7 btn-lg" type="submit" @isset($disabled) {{$disabled}} @endisset>Добави</button>
                </div>


            </div>

            @if($errors->has('ean'))
                <div class="p-3 mb-2 bg-danger text-white">{{ $errors->first('ean') }}</div>
            @endif
            @if($errors->has('quantity'))
                <div class="p-3 mb-2 bg-danger text-white">{{ $errors->first('quantity') }}</div>
            @endif

            @isset($posts)

                <div class="list-group">
                    @foreach($posts as $post)
                        <a href="/additem?id={{ $post->id }}&quantity={{$quantity}}&salesId={{$salesId}}" class="list-group-item list-group-item-action"> {{ $post->name }} - {{ $post->ean }} - {{ $post->sale_price }}</a>
                    @endforeach
                </div>
        @endisset

        </form>

@endif
