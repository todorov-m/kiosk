<?php

namespace App\Http\Livewire;

use App\Models\SaleHead;
use Livewire\Component;

class NewsaleTotal extends Component
{
    public $salesId;
    public $total = '';
    public $payd = '0';
    public $resto = '';

    public function render()
    {
//$this->total = $this->salesId;
       $sale = SaleHead::findOrFail($this->salesId);

       $this->total = $sale->total;
       if($this->payd >= '0') {
           $this->resto = $this->payd - $this->total;
       }
        return view('livewire.newsale-total');
    }
    public function saleSave($salesId, $userId) {

        $newsale = new SaleHead;
        $newsale->users_id=$userId;
        $newsale->save();
        $saleid = $newsale->id;


        return view('livewire.newsale')->with([
            'salesId' => $saleid,
            'message'=> '1'
        ]);

    }
    public function saleClose($salesId, $userId) {
        return view('/');

    }
}
