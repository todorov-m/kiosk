<?php

namespace App\Http\Livewire;

use App\Models\SaleContent;
use App\Models\SaleHead;
use App\Models\User;
use App\Models\Item;
use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Sales extends LivewireDatatable
{
    public function builder()
    {
       if(auth()->user()->level > 90) {
           return SaleHead::query()
               ->where('status', '<', 99)
               ->orderBy('id', 'desc');
       } else {
           return SaleHead::query()
               ->where('status', '<', 99)
               ->where('users_id',auth()->user()->id)
               ->orderBy('id', 'desc');
       }

    }



    function columns()
    {
        return [

            Column::name('id')
                ->link('/newsales/{{id}}')
                ->label('#'),

            DateColumn::name('salesDate')
                ->label('Дата')
                ->filterable(),

            Column::name('users.username')
                ->filterable($this->users->pluck('username'))
                ->label('Оператор'),


            Column::name('total')
                ->label('Сума'),


            Column::callback(['id','status'], function ($id,$status) {
               if($status ==0 ) {
                   return '<a href="/newsales/'.$id.'" class="text-danger">Незавършена</a>';
               } else {
                   return '<div class="text-success">Приключена</div>';
               }
            })->label('Статус'),




        ];
    }

    public function getUsersProperty()
    {
        return User::all();
    }

    public function getStatusProperty()
    {
        return SaleHead::all();
    }
}
