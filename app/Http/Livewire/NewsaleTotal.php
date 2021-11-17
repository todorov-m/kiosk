<?php

namespace App\Http\Livewire;

use App\Models\SaleContent;
use App\Models\SaleHead;
use Livewire\Component;

class NewsaleTotal extends Component
{
    public $salesId;
    public $total = '';
    public $payd = '0';
    public $resto = '';
    public $status = '';
    public $startsale = '';
    public $endsale = '';

    public function render()
    {
//$this->total = $this->salesId;
       $sale = SaleHead::findOrFail($this->salesId);
       $content = SaleContent::where('sale_heads_id',$this->salesId)->get();
        $sumtax7 = SaleContent::where('sale_heads_id', $this->salesId)
            ->where('tax', 7)
            ->sum('linetotal');

        $sumtax19 = SaleContent::where('sale_heads_id', $this->salesId)
            ->where('tax', 19)
            ->sum('linetotal');

        $tax7 = SaleContent::where('sale_heads_id', $this->salesId)
            ->where('tax', 7)
            ->get();
        $tax19 = SaleContent::where('sale_heads_id', $this->salesId)
            ->where('tax', 19)
            ->get();




       $this->total = $sale->total;
       $this->status = $sale->status;
       $this->startsale = $sale->created_at;
       $this->endsale = $sale->updated_at;

       if($this->payd >= '0') {
           $this->resto = $this->payd - $this->total;
       }
        return view('livewire.newsale-total', ['sales' => $content, 'tax7'=>$tax7, 'tax19'=>$tax19, 'sumtax7'=>$sumtax7, 'sumtax19'=>$sumtax19, 'hea' ]);
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
