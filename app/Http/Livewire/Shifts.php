<?php

namespace App\Http\Livewire;

use App\Models\Saldo;
use App\Models\SaleContent;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Shifts extends LivewireDatatable
{
    public function builder()
    {
        return Saldo::query()
            ->orderBy('id', 'desc');

    }



    function columns()
    {
        return [

            Column::name('id')
                ->label('#'),

            DateColumn::name('shiftstart_date	')
                ->label('Дата')
                ->filterable(),

            Column::name('users.username')
                ->filterable($this->users->pluck('username'))
                ->label('Оператор'),


            Column::name('shiftstart_sum')
                ->label('Начално салдо'),

            Column::name('shiftsale_sum')
                ->label('Продажби'),

            Column::name('shiftend_sum')
                ->label('Крайно салдо'),

            Column::name('created_at')
                ->label('Старт на смяна'),

            Column::name('updated_at')
                ->label('Край на смяна'),

            Column::callback(['id','shiftstatus'], function ($id,$shiftstatus) {
                if($shiftstatus ==0 ) {
                    return '<div class="text-danger">Незавършена</div>';
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
