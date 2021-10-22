<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\SaleContent;
use App\Models\SaleHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    # Заглавна част на продажбата
    public function store(){

        $data = request()->validate([
            'users_id' => 'required',
            'total' => 'required',
            'status' => 'required'
        ]);


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

//TODO събиране на количества и сума на еднакви Баркодове
            //Обща сума на Продажбата

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

            return view('livewire.newsale')->with([
                'salesId' => $data['salesId'],
                'message'=> '1'
            ]);
        }
    }



}
