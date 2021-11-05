<?php

namespace App\Http\Livewire;

use App\Models\SaleContent;
use App\Models\SaleHead;
use App\Models\Item;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class Newsale extends LivewireDatatable
{
    public $salesId;
    public $userlevel;



    public function builder()
    {
        return SaleContent::query()
        ->where('sale_heads_id', $this->salesId)
        ->orderBy('id', 'desc');

    }



    function columns()
    {
        return [
           Column::name('ean')
                ->label('Баркод'),
            Column::name('name')->label('Име'),
            Column::name('single_price')
                ->label('Ед. цена'),
            Column::name('quantity')
                ->label('Кол.'),
            Column::name('linetotal')
                ->label('Сума'),

            Column::callback(['id'], function ($id) {
            if($this->userlevel > 90) {
                    return view('sales.action', ['id' => $id, 'salesId' => $this->salesId]);
                }
            })->unsortable()

        ];
    }


}