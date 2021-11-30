<?php

namespace App\Http\Controllers;

use App\Models\DailyClose;
use App\Models\SaleHead;
use DB;
use Illuminate\Http\Request;

class DailyCloseController extends Controller
{
    public function create() {
        $data = request()->validate([
            'salesDate' => 'required',
            'users_id' => 'required'
        ]);

        $dailyclose = DailyClose::where('daily_close_date', $data['salesDate'])->first();

        if(isset($dailyclose->id)) {
            return view('reports.dailyclose')->with([
                'daily_close_date' => $dailyclose->daily_close_date,
                'users_id' => $dailyclose->users_id,
                'daily_close_total' => $dailyclose->daily_close_total,
                'daily_close_total_7' => $dailyclose->daily_close_total_7,
                'daily_close_total_19' => $dailyclose->daily_close_total_19,
                'daily_close_status' => $dailyclose->daily_close_status,
                'status' => '1'
            ]);

        } else {
            $sales = DB::table('sale_heads')
                ->select(DB::raw('sum(total_7) as total_7, sum(total_19) as total_19, sum(total) as total'))
                ->where('status', '<', 90)
                ->where('salesDate', $data['salesDate'])
                ->first();

            $create_new = DailyClose::create([
                'users_id' => $data['users_id'],
                'daily_close_date' => $data['salesDate'],
                'daily_close_total' => $sales->total,
                'daily_close_total_7' => $sales->total_7,
                'daily_close_total_19' => $sales->total_19,
                'daily_close_status' => '1',
            ]);
//TODO Да се довърши изгледа на дневен отчет
            return view('reports.dailyclose')->with([
                'daily_close_date' => $data['salesDate'],
                'users_id' => $data['users_id'],
                'daily_close_total' => $sales->total,
                'daily_close_total_7' => $sales->total_7,
                'daily_close_total_19' => $sales->total_19,
                'status' => '1'
            ]);


        }

    }
}
