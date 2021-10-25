<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\SaleContent;
use App\Models\SaleHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    # Заглавна част на продажбата
    public function store(){

        $data = request()->validate([
            'users_id' => 'required',
            'total' => 'required',
            'status' => 'required',
            'salesId' => 'required',
            'payd' => ''
        ]);

        if($data['salesId']>'0'){
            SaleHead::where('id', $data['salesId'])
                ->update([
                    'status' => '1',
                    'payd' => floatval($data['payd'])
                ]);
            }

        $data['payd'] ='0';

        $saleid = SaleHead::create($data)->id;

        return view('livewire.newsale')->with([
            'salesId' => $saleid,
            'message'=> '1'
        ]);

    }

    #Съдържание на Продажбата
    public function submit()
    {
        $data = request()->all();

        $validator = Validator::make(request()->all(), [
            'ean' => 'required|exists:items,ean',
            'quantity' => 'required',
            'salesId' => 'required'
        ]);

        if ($validator->fails()) {
            return view('livewire.newsale')->with([
                'salesId' => $data['salesId'],
                'message'=> '0'
            ]);
        } else {

            $item = Item::where('ean', $data['ean'])->first();

            $saleitem = SaleContent::where('items_id', $item->id)->where('sale_heads_id', $data['salesId'])->first();

            // проверка дали артикула съществува в Продажбата, ако ДА обновява количество и сума на ред, ако не създава Нов ред
            if(isset($saleitem->id)){
                $saleitem->quantity = $saleitem->quantity+$data['quantity'];
                $saleitem->linetotal = $saleitem->quantity * $item->sale_price;

                SaleContent::where('items_id', $item->id)
                    ->where('sale_heads_id', $data['salesId'])
                    ->update([
                        'quantity' => $saleitem->quantity,
                        'linetotal' => $saleitem->linetotal
                    ]);
                //Нов Тотал на документа
                $total = SaleContent::where('sale_heads_id', $data['salesId'])
                    ->sum('linetotal');

                SaleHead::where('id', $data['salesId'])
                    ->update([
                        'total' => $total
                    ]);

            }
            else {

                $linetotal = $data['quantity'] * $item->sale_price;

                $salescontent = SaleContent::create([
                    'sale_heads_id' => $data['salesId'],
                    'items_id' => $item->id,
                    'ean' => $data['ean'],
                    'name' => $item->name,
                    'tax' => $item->tax,
                    'quantity' => $data['quantity'],
                    'single_price' => $item->sale_price,
                    'linetotal' => $linetotal

                ]);

                //Нов Тотал на документа
                $total = SaleContent::where('sale_heads_id', $data['salesId'])
                    ->sum('linetotal');

                SaleHead::where('id', $data['salesId'])
                    ->update([
                        'total' => $total
                    ]);
            }

            return view('livewire.newsale')->with([
                'salesId' => $data['salesId'],
                'message'=> '1'
            ]);
        }
    }



}
