<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{   

    function addItemIndex()
    {
        $items = Item::paginate(25);
        $categories = Category::get();
        return view('pos.add_item', compact(['items', 'categories']) );
    }


    function searchItem(Request $request)
    {
        $items = Item::where('name', 'like', "%$request->s%")->get(['name', 'price', 'id']);
        return response($items);
    }


    function getItems()
    {
        $items = Item::get(['id', 'name', 'price']);
        return response([
            'results' => $items
        ]);
    }


    public function addItem(Request $request)
    {
        Validator::make($request->all(), [
            'category_id' => 'integer|required|exists:categories,id',
            'name' => 'string|min:3|required|unique:items,name',
            'price' => 'integer|required|min:10',
            'description' => '',
        ])->validate();

        Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);

        return back()->with('success', 'Item has been added successfuly');
    }


    function updateItemPrice(Request $request)
    {
        
        Item::where('id', $request->id)->update([
            'price' => $request->price
        ]);
    
        return back()->with('success', 'Item price has been changed');
    }


    function updateItem(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'integer|required|exists:items,id',
            'name' => 'string|min:3|required|unique:items,name',
            'price' => 'integer|required|min:10',
            'description' => 'string',
        ])->validate();

        Item::where('id', $request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);
        return back()->with('success', 'Item info has been updated');
    }
}
