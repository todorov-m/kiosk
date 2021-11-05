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
        return view('livewire.newsale')->with([
            'salesId' => $salesId,
            'oldsalesId' => $salesId,
            'message'=> $message
        ]);

    }

    # Заглавна част на продажбата
    public function store(){
       $message = '1';

        $data = request()->validate([
            'users_id' => 'required',
            'total' => 'required',
            'status' => 'required',
            'salesId' => 'required',
            'payd' => ''
        ]);

        if($data['salesId']>'0'){
            $total = SaleContent::where('sale_heads_id', $data['salesId'])->sum('linetotal');
            SaleHead::where('id', $data['salesId'])
                ->update([
                    'status' => '1',
                    'payd' => floatval($data['payd']),
                    'total' => floatval($total)
                ]);

            $tax7 = SaleContent::where('sale_heads_id', $data['salesId'])
                ->where('tax', 7)
                ->get();
            $tax19 = SaleContent::where('sale_heads_id', $data['salesId'])
                ->where('tax', 19)
                ->get();

            $pdf = PDF::loadView('sales.receipt',['tax7'=>$tax7, 'tax19'=>$tax19])->setOptions(['defaultFont' => 'sans-serif']); // <--- load your view into theDOM wrapper;
            $path = public_path('/receipt/'); // <--- folder to store the pdf documents into the server;
            $fileName =  'receipt.pdf' ; // <--giving the random filename,
            $pdf->save(public_path().'/receipt/receipt_'.$data['salesId'].'.pdf');
            $message = '3';
            //TODO да се отбележе в базата че е печатана разписка
            }

        $data['payd'] ='0';
//TODO проверка за започнало на Смяна

        $saleid = SaleHead::create($data)->id;

        return view('livewire.newsale')->with([
            'salesId' => $saleid,
            'oldsalesId' => $data['salesId'],
            'message'=> $message
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
        $total = SaleContent::where('sale_heads_id', $data['salesId'])
            ->sum('linetotal');

        SaleHead::where('id', $data['salesId'])
            ->update([
                'total' => $total
            ]);

       return redirect('newsales/'.$salesId)->with('success', 'Успешно изтрит ред!');


    }

    public function listsale($id){
        $salehead = SaleHead::find($id);

        $salecontent = SaleContent::where('sales_id', $id);
dd ($salecontent);
//TODO Да се довърши изгледа на продажбата
        return view('sales.listsale', ["heads" => $salehead , "contents" => $salecontent]);

    }


}
