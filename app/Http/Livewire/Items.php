<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Items extends LivewireDatatable
{
    public $model = Item::class;
    public $ean;
    public $name;
    public $delivery_price;
    public $sale_price;
    public $tax;

    public function submit()
    {
        $data = request()->validate([
            'ean' => 'required',
            'name' => 'required',
            'delivery_price' => 'required',
            'sale_price' => 'required',
            'tax' => 'required',
              ]);

        Item::create($data);

        return back()->with('success', 'Артикула е добавен!');
    }

    function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->sortBy('id'),
            Column::name('ean')
                 ->label('Баркод'),
            Column::name('name')->label('Име'),
            Column::name('delivery_price')
                ->editable()
                ->label('Доставна цена'),
            Column::name('sale_price')
                ->editable()
                ->label('Продажна цена'),
            Column::name('tax')
                ->sortBy('tax')
                ->label('Група данък')
        ];
    }
}
