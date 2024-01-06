<?php

namespace App\Http\Controllers;

use App\Models\Restock;
use App\Models\RestockSummary;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    function restockIndex()
    {
        return view('admin.re_stock');
    }


    function restockItem(Request $request)
    {
 

        $supplier_id = $this->updateOrCreateSupplier($request->supplier_phone);


        $summary = RestockSummary::create([
            'supplier_id' => $supplier_id,
            'total' => 0,
            'amount_paid' => $request->advance
        ]);


        $cart_total = 0;

        foreach ($request->items as $item) {
            $price = $item['price'];
            $item_id = $item['id'];
            $qty = $item['qty'];
            $item_total = ($price * $qty);

            $cart_total += $item_total;


            $res = Restock::create([
                'summary_id' => $summary->id,
                'item_id' => $item_id,
                'quantity' => $qty,
                'price' => $price
            ]);


            Stock::create([
                'item_id' => $item_id,
                'customer_id' => $supplier_id,
                'summary_id' => $res->id,
                'price' => $price,
                'quantity' => $qty,
                'total' => $item_total,
                'action' => 'restock',
                'user_id' => auth()->user()->id
            ]);
        }

        $summary->update([
            'total' => $cart_total
        ]);

        return response([
            'message' => 'Items has been added to stock',
            'sales_id' => $summary->id,
            'status' => true
        ]);
    }



    function updateOrCreateSupplier($phone)
    {
        $sup = Supplier::updateOrCreate([
            'phone' => $phone
        ]);

        return $sup->id;
    }
}
