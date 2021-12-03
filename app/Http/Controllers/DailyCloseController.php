<?php

namespace App\Http\Controllers;

use App\Models\DailyClose;
use App\Models\SaleContent;
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

            $sales = DB::table('sale_heads')
                ->select(DB::raw('sum(total_7) as total_7, sum(total_19) as total_19, sum(total) as total, count(id) as sales_count'))
                ->where('status', '<', 90)
                ->where('salesDate', $data['salesDate'])
                ->first();

            $item_count_7 = DB::table('sale_heads')
                ->join('sale_contents', 'sale_heads.id', '=', 'sale_contents.sale_heads_id')
                ->selectRaw('sum(quantity) as items_7')
                ->where('sale_contents.tax', 7)
                ->where('sale_heads.salesDate', $data['salesDate'])
                ->where('sale_heads.status', '<', 90)
                ->first();

            $item_count_19 = DB::table('sale_heads')
                ->join('sale_contents', 'sale_heads.id', '=', 'sale_contents.sale_heads_id')
                ->selectRaw('sum(quantity) as items_19')
                ->where('sale_contents.tax', 19)
                ->where('sale_heads.salesDate', $data['salesDate'])
                ->where('sale_heads.status', '<', 90)
                ->first();


            DailyClose::where('id', $dailyclose->id)
                ->update([
                    'users_id' => $data['users_id'],
                    'daily_close_total' => $sales->total,
                    'daily_close_total_7' => $sales->total_7,
                    'daily_close_total_19' => $sales->total_19,
                    'daily_sales_count' => $sales->sales_count,
                    'daily_item_count_7' => $item_count_7->items_7,
                    'daily_item_count_19' => $item_count_19->items_19,
                    'daily_close_status' => '1',

                ]);
            $dailyclose_data = DailyClose::where('id', $dailyclose->id)->first();

            return view('reports.dailyclose')->with([
                'daily_close_id' => $dailyclose_data->id,
                'daily_close_date' => $dailyclose_data->daily_close_date,
                'close_create_date' => $dailyclose_data->created_at,
                'users_id' => $dailyclose_data->users_id,
                'daily_close_total' => $dailyclose_data->daily_close_total,
                'daily_close_total_7' => $dailyclose_data->daily_close_total_7,
                'daily_close_total_19' => $dailyclose_data->daily_close_total_19,
                'daily_close_status' => $dailyclose_data->daily_close_status,
                'daily_item_count_7' => $dailyclose_data->daily_item_count_7,
                'daily_item_count_19' => $dailyclose_data->daily_item_count_19,
                'daily_sales_count' => $dailyclose_data->daily_sales_count,
                'status' => '1'
            ]);

        } else {
            $sales = DB::table('sale_heads')
                ->select(DB::raw('sum(total_7) as total_7, sum(total_19) as total_19, sum(total) as total, count(id) as sales_count'))
                ->where('status', '<', 90)
                ->where('salesDate', $data['salesDate'])
                ->first();

            $item_count_7 = DB::table('sale_heads')
                ->join('sale_contents', 'sale_heads.id', '=', 'sale_contents.sale_heads_id')
                ->selectRaw('sum(quantity) as items_7')
                ->where('sale_contents.tax', 7)
                ->where('sale_heads.salesDate', $data['salesDate'])
                ->where('sale_heads.status', '<', 90)
                ->first();

            $item_count_19 = DB::table('sale_heads')
                ->join('sale_contents', 'sale_heads.id', '=', 'sale_contents.sale_heads_id')
                ->selectRaw('sum(quantity) as items_19')
                ->where('sale_contents.tax', 19)
                ->where('sale_heads.salesDate', $data['salesDate'])
                ->where('sale_heads.status', '<', 90)
                ->first();


            $create_newID = DailyClose::create([
                'users_id' => $data['users_id'],
                'daily_close_date' => $data['salesDate'],
                'daily_close_total' => $sales->total,
                'daily_close_total_7' => $sales->total_7,
                'daily_close_total_19' => $sales->total_19,
                'daily_sales_count' => $sales->sales_count,
                'daily_item_count_7' => $item_count_7->items_7,
                'daily_item_count_19' => $item_count_19->items_19,
                'daily_close_status' => '1',
            ])->id;

            $dailyclose_data= DailyClose::where('id', $create_newID)->first();


            return view('reports.dailyclose')->with([
                'daily_close_id' => $sales->id,
                'daily_close_date' => $data['salesDate'],
                'close_create_date' => $dailyclose_data->created_at,
                'users_id' => $data['users_id'],
                'daily_close_total' => $sales->total,
                'daily_close_total_7' => $sales->total_7,
                'daily_close_total_19' => $sales->total_19,
                'daily_item_count_7' => $dailyclose_data->daily_item_count_7,
                'daily_item_count_19' => $dailyclose_data->daily_item_count_19,
                'daily_sales_count' => $dailyclose_data->daily_sales_count,
                'status' => '1'
            ]);


        }

    }
}
