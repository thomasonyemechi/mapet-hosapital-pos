<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Sales;
use App\Models\SalesSummary;
use App\Models\Stock;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    function makeSales(Request $request)
    {

        $customer_id = $this->updateOrCreateClient($request->customer_phone);


        $summary = SalesSummary::create([
            'customer_id' => $customer_id,
            'total' => 0,
            'user_id' => auth()->user()->id
        ]);



        $cart_total = 0;

        foreach ($request->items as $item) {
            $price = $item['price'];
            $item_id = $item['id'];
            $qty = $item['qty'];
            $item_total = ($price * $qty);

            $cart_total += $item_total;


            $res = Sales::create([
                'summary_id' => $summary->id,
                'item_id' => $item_id,
                'quantity' => $qty,
                'price' => $price
            ]);


            Stock::create([
                'item_id' => $item_id,
                'customer_id' => $customer_id,
                'summary_id' => $res->id,
                'price' => $price,
                'quantity' => -$qty,
                'total' => $item_total,
                'action' => 'sales',
                'user_id' => auth()->user()->id
            ]);
        }



        $summary->update([
            'total' => $cart_total
        ]);

        return response([
            'message' => 'Sales has been logged',
            'sales_id' => $summary->id,
            'status' => true
        ]);
    }



    function updateOrCreateClient($phone)
    {
        $client = Client::updateOrCreate([
            'phone' => $phone
        ]);

        return $client->id;
    }


    function todaySales(Request $request,$id = 0, $date = '')
    {
        $id = ($id) ? $id : auth()->user()->id;

        $date = isset($request->date) ? $request->date : '';
        $day = ($date) ? date('Y-m-d', strtotime($date)) : date('Y-m-d');


        $total_sales = SalesSummary::where(['user_id' => $id])->where('created_at', 'like', "%$day%")->count();
        $amount = SalesSummary::where(['user_id' => $id])->where('created_at', 'like', "%$day%")->sum('total');
        $sales = SalesSummary::with(['sales', 'customer'])->where('created_at', 'like', "%$day%")->orderBy('id', 'desc')->paginate(25);


        return view('pos.today_sales', compact(['total_sales', 'amount', 'sales', 'day']));
    }
}
