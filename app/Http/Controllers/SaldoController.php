<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\SaleHead;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    public function index(){
        $saldo = Saldo::where('users_id', auth()->user()->id)
           // ->whereRaw('DATE(shiftstart_date) = CURDATE()')
            ->where('shiftstatus',0)
            ->first();
        if (!$saldo){
            return view('sales.startshift');

        } else {

            $shiftsale_sum = SaleHead::where('users_id', auth()->user()->id)
                ->where('status', '<', 99)
                ->where('saldos_id', $saldo->id)
                // ->whereRaw('DATE(created_at) = CURDATE()')
                ->sum('total');

            return view('sales.shiftsaldo')->with([
                'shiftstart_sum' => $saldo->shiftstart_sum,
                'shiftsale_sum' => $shiftsale_sum,
                'shiftend_sum' => $saldo->shiftend_sum,
                'shiftstatus' => $saldo->shiftstatus,
                'shift_id' => $saldo->id
            ]);

        }
    }

    public function clearsale($salesId){

        SaleHead::where('id', $salesId)
            ->update([
                'status' => '99'
            ]);

        $saldo = Saldo::where('users_id', auth()->user()->id)
            ->where('shiftstatus',0)
            ->first();

        $shiftsale_sum = SaleHead::where('users_id',auth()->user()->id)
            ->where('status',1)
            ->where('saldos_id', $saldo->id)
           // ->whereRaw('DATE(created_at) = CURDATE()')
            ->sum('total');

        return view('sales.shiftsaldo')->with([
            'shiftstart_sum' => $saldo->shiftstart_sum,
            'shiftsale_sum' => $shiftsale_sum,
            'shiftend_sum' => $saldo->shiftend_sum,
            'shiftstatus'=> $saldo->shiftstatus,
            'shift_id' => $saldo->id
        ]);


    }



    public function store(){

        $data = request()->validate([
            'users_id' => 'required',
            'shiftstart_sum' => 'required'
        ]);
        $data['shiftstart_sum'] = str_replace(',','.',$data['shiftstart_sum']);

        $saldoid = Saldo::create($data)->id;

        $saldo = Saldo::where('id',$saldoid)->first();

        return view('sales.shiftsaldo')->with([
            'shiftstart_sum' => $saldo->shiftstart_sum,
            'shiftsale_sum' => $saldo->shiftsale_sum,
            'shiftend_sum' => $saldo->shiftend_sum,
            'shiftstatus'=> $saldo->shiftstatus,
            'shift_id' => $saldo->id
        ]);

    }

    public function shiftend(){
        $data = request()->validate([
            'shift_id' => 'required',
            'shiftsale_sum' => 'required',
            'shiftend_sum' => 'required'
        ]);

        Saldo::where('id', $data['shift_id'])
            ->update([
                'shiftstatus' => '1',
                'shiftsale_sum' => floatval($data['shiftsale_sum']),
                'shiftend_sum' => floatval($data['shiftend_sum'])
            ]);
        return view('sales.startshift');
    }
}
