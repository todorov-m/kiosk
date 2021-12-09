<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\SaleContent;
use App\Models\SaleHead;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Search extends Component
{
    public $salesId;
    public $status;
    public $message;
    public $ean;
    public $quantity;


    protected $rules = [
        'ean' => 'required|exists:items,ean',
        'salesId' => 'required'
    ];

    protected $queryString = ['ean'];

    public function render()
    {
        if (preg_match('/^[0-9]+$/', $this->ean) || strlen($this->ean) < 4) {
            return view('livewire.search');
        } else {
            return view('livewire.search', [
                'posts' => Item::where('name', 'like', '%' . $this->ean . '%')->get(),
                'quantity' => $this->quantity,
                'save' => 'disabled',
            ]);

        }
    }

    #Съдържание на Продажбата
    public function submit()
    {

        $validatedData = $this->validate([
            'ean' => 'required|exists:items,ean',
        ]);
        $this->quantity = str_replace(',','.',$this->quantity);


        $item = \DB::table('items')->where('ean', $this->ean)->first();
        // $item = Item::where('ean', $data['ean'])->first();
        if ($item->packing != 1){
            $validatedData = $this->validate([
                  'quantity' => 'required|regex:/^[\d]*[\.]\d{3}$/',

            ]);

        }

        $saleitem = SaleContent::where('items_id', $item->id)->where('sale_heads_id', $this->salesId)->first();

        // проверка дали артикула съществува в Продажбата, ако ДА обновява количество и сума на ред, ако не създава Нов ред
        if (isset($saleitem->id)) {
            $saleitem->quantity = $saleitem->quantity + $this->quantity;
            $saleitem->linetotal = $saleitem->quantity * $item->sale_price;

            SaleContent::where('items_id', $item->id)
                ->where('sale_heads_id', $this->salesId)
                ->update([
                    'quantity' => $saleitem->quantity,
                    'linetotal' => $saleitem->linetotal
                ]);
            //Нов Тотал на документа
            $total_7 = SaleContent::where('sale_heads_id', $this->salesId)
                ->where('tax', 7)
                ->sum('linetotal');

            $total_19 = SaleContent::where('sale_heads_id', $this->salesId)
                ->where('tax', 19)
                ->sum('linetotal');

            $total = SaleContent::where('sale_heads_id', $this->salesId)
                ->sum('linetotal');
            $headtotal = SaleHead::where('id', $this->salesId)->first();

            $resto = $headtotal->payd - $total;

            SaleHead::where('id', $this->salesId)
                ->update([
                    'total' => $total,
                    'total_7' => $total_7,
                    'total_19' => $total_19,
                    'resto' => $resto
                ]);

        } else {

            $linetotal = $this->quantity * $item->sale_price;

            $salescontent = SaleContent::create([
                'sale_heads_id' => $this->salesId,
                'items_id' => $item->id,
                'ean' => $this->ean,
                'name' => $item->name,
                'tax' => $item->tax,
                'quantity' => $this->quantity,
                'packing' =>$item->packing,
                'single_price' => $item->sale_price,
                'single_delivery_price' => $item->delivery_price,
                'linetotal' => $linetotal

            ]);

            //Нов Тотал на документа
            $total_7 = SaleContent::where('sale_heads_id', $this->salesId)
                ->where('tax', 7)
                ->sum('linetotal');

            $total_19 = SaleContent::where('sale_heads_id', $this->salesId)
                ->where('tax', 19)
                ->sum('linetotal');

            $total = SaleContent::where('sale_heads_id', $this->salesId)
                ->sum('linetotal');
            $headtotal = SaleHead::where('id', $this->salesId)->first();

            $resto = $headtotal->payd - $total;
            SaleHead::where('id', $this->salesId)
                ->update([
                    'total' => $total,
                    'total_7' => $total_7,
                    'total_19' => $total_19,
                    'resto' => $resto
                ]);
        }

        return redirect('newsales/'.$this->salesId);




    }



}
