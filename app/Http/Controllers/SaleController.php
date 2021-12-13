<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\SaleContent;
use App\Models\SaleHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;


class SaleController extends Controller
{
    public function getsale($salesId){
        $message = 1;
           $sale = SaleHead::where('id', $salesId)->first();

            return view('livewire.newsale')->with([
                'salesId' => $salesId,
                'salesDate' => $sale->salesDate,
                'oldsalesId' => $salesId,
                'shift_id' => $sale->saldos_id,
                'message'=> $message,
                'status' => $sale->status
            ]);

        }


    public function getsalean($salesId, $ean, $quantity){
        $message = 1;

            $sale = SaleHead::where('id', $salesId)->first();

            return view('livewire.newsale')->with([
                'salesId' => $salesId,
                'salesDate' => $sale->salesDate,
                'oldsalesId' => $salesId,
                'shift_id' => $sale->saldos_id,
                'message'=> $message,
                'status' => $sale->status,
                'quantity' => $quantity,
                'items' => Item::where('ean', $ean)->get(),
            ]);

    }

    # Заглавна част на продажбата
    public function store(){
       $message = '1';
       $request = request();

        $data = request()->validate([
            'users_id' => 'required',
            'total' => 'required',
            'status' => 'required',
            'salesId' => 'required',
            'saldos_id' => 'required',
            'salesDate'=> ''
        ]);

        if($data['salesId']>'0'){
            $total = SaleContent::where('sale_heads_id', $data['salesId'])->sum('linetotal');
            SaleHead::where('id', $data['salesId'])
                ->update([
                    'status' => '1',
                    'total' => floatval($total)
                ]);

            return redirect('/newsales/'.$data['salesId']);
/* Генериране на ПДФ фай с разписката
            $sumtax7 = SaleContent::where('sale_heads_id', $data['salesId'])
                ->where('tax', 7)
                ->sum('linetotal');

            $sumtax19 = SaleContent::where('sale_heads_id', $data['salesId'])
                ->where('tax', 19)
                ->sum('linetotal');

            $tax7 = SaleContent::where('sale_heads_id', $data['salesId'])
                ->where('tax', 7)
                ->get();
            $tax19 = SaleContent::where('sale_heads_id', $data['salesId'])
                ->where('tax', 19)
                ->get();
            $sales = SaleContent::where('sale_heads_id', $data['salesId'])
                ->get();

            $pdf = PDF::loadView('sales.receipt',['tax7'=>$tax7, 'tax19'=>$tax19, 'sumtax7'=>$sumtax7, 'sumtax19'=>$sumtax19, 'sales'=>$sales ])->setOptions(['defaultFont' => 'sans-serif']); // <--- load your view into theDOM wrapper;
            $path = public_path('/receipt/'); // <--- folder to store the pdf documents into the server;
            $fileName =  'receipt.pdf' ; // <--giving the random filename,
            $pdf->save(public_path().'/receipt/receipt_'.$data['salesId'].'.pdf');
            $message = '3';
            */

            }
        else {

            $data['payd'] = '0';
            $data['salesDate'] = date('Y-m-d');

            $saleid = SaleHead::create($data)->id;

            return view('livewire.newsale')->with([
                'salesId' => $saleid,
                'shift_id' => $data['saldos_id'],
                'oldsalesId' => $data['salesId'],
                'message' => $message,
                'status' => 0
            ]);
        }

    }

    #Съдържание на Продажбата
    public function submit(Request $request)
    {
        $item_id = $request->input('id');


        $item = \DB::table('items')->where('id', $item_id)->first();
        if ($item->packing != 1) {
            $data = request()->validate([
                'salesId' => 'required',
                'id' => 'required',
                'quantity' => 'required|regex:/^[\d]*[\.]\d{3}$/',
            ]);
        } else {
            $data = request()->validate([
                'salesId' => 'required',
                'id' => 'required',
                'quantity' => 'required',
            ]);
        }

        $data['quantity'] = str_replace(',','.',$data['quantity']);

                $item = \DB::table('items')->where('id', $data['id'])->first();
                // $item = Item::where('ean', $data['ean'])->first();

                $saleitem = SaleContent::where('items_id', $item->id)->where('sale_heads_id', $data['salesId'])->first();

                // проверка дали артикула съществува в Продажбата, ако ДА обновява количество и сума на ред, ако не създава Нов ред
                if (isset($saleitem->id)) {
                    $saleitem->quantity = $saleitem->quantity + $data['quantity'];
                    $saleitem->linetotal = $saleitem->quantity * $item->sale_price;

                    SaleContent::where('items_id', $item->id)
                        ->where('sale_heads_id', $data['salesId'])
                        ->update([
                            'quantity' => $saleitem->quantity,
                            'linetotal' => $saleitem->linetotal
                        ]);
                    //Нов Тотал на документа
                    $total_7 = SaleContent::where('sale_heads_id', $data['salesId'])
                        ->where('tax', 7)
                        ->sum('linetotal');

                    $total_19 = SaleContent::where('sale_heads_id', $data['salesId'])
                        ->where('tax', 19)
                        ->sum('linetotal');

                    $total = SaleContent::where('sale_heads_id', $data['salesId'])
                        ->sum('linetotal');
                    $headtotal = SaleHead::where('id', $data['salesId'])->first();

                    $resto = $headtotal->payd - $total;

                    SaleHead::where('id', $data['salesId'])
                        ->update([
                            'total' => $total,
                            'total_7' => $total_7,
                            'total_19' => $total_19,
                            'resto' => $resto
                        ]);

                } else {

                    $linetotal = $data['quantity'] * $item->sale_price;

                    $salescontent = SaleContent::create([
                        'sale_heads_id' => $data['salesId'],
                        'items_id' => $item->id,
                        'ean' => $item->ean,
                        'name' => $item->name,
                        'tax' => $item->tax,
                        'quantity' => $data['quantity'],
                        'packing' => $item->packing,
                        'single_price' => $item->sale_price,
                        'single_delivery_price' => $item->delivery_price,
                        'linetotal' => $linetotal

                    ]);

                    //Нов Тотал на документа
                    $total_7 = SaleContent::where('sale_heads_id', $data['salesId'])
                        ->where('tax', 7)
                        ->sum('linetotal');

                    $total_19 = SaleContent::where('sale_heads_id', $data['salesId'])
                        ->where('tax', 19)
                        ->sum('linetotal');

                    $total = SaleContent::where('sale_heads_id', $data['salesId'])
                        ->sum('linetotal');
                    $headtotal = SaleHead::where('id', $data['salesId'])->first();

                    $resto = $headtotal->payd - $total;
                    SaleHead::where('id', $data['salesId'])
                        ->update([
                            'total' => $total,
                            'total_7' => $total_7,
                            'total_19' => $total_19,
                            'resto' => $resto
                        ]);
                }

                return view('livewire.newsale')->with([
                    'salesId' => $data['salesId'],
                    'message' => '1',
                    'status' => $headtotal->status
                ]);


    }

    public function deleterow(){
        $message = '1';

        $data = request()->validate([
            'users_id' => 'required',
            'total' => 'required',
            'status' => 'required',
            'salesId' => 'required',
            'recordId' => 'required'
        ]);
        $salesId = $data['salesId'];
        SaleContent::destroy($data['recordId']);

        //Нов Тотал на документа
        $total_7 = SaleContent::where('sale_heads_id', $data['salesId'])
            ->where('tax', 7)
            ->sum('linetotal');

        $total_19 = SaleContent::where('sale_heads_id', $data['salesId'])
            ->where('tax', 19)
            ->sum('linetotal');

        $total = SaleContent::where('sale_heads_id', $data['salesId'])
            ->sum('linetotal');

        $headtotal = SaleHead::where('id', $data['salesId'])->first();

        $resto = $headtotal->payd - $total;
        SaleHead::where('id', $data['salesId'])
            ->update([
                'total' => $total,
                'total_7' => $total_7,
                'total_19' => $total_19,
                'resto' => $resto
            ]);

       return redirect('newsales/'.$salesId)->with('success', 'Успешно изтрит ред!');


    }

    public function listsale($id){

        $salehead = SaleHead::find($id);

        $salecontent = SaleContent::where('sale_heads_id', $id)->get();

        return view('sales.listsale', ['heads' => $salehead , 'contents' => $salecontent]);

    }

    public function custompayd()
    {

        $data = request()->validate([
            'payd' => 'required',
            'salesId' => 'required'
        ]);

        $sales=SaleHead::where('id', $data['salesId'])->first();
        $resto = $data['payd'] - $sales->total;

        SaleHead::where('id', $data['salesId'])
            ->update([
                'payd' => $data['payd'],
                'resto' => $resto
            ]);
        return redirect('/newsales/'.$data['salesId']);

    }


}
