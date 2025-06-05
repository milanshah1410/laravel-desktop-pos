<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        return view('pos', ['products' => Product::all()]);
    }

    public function checkout(Request $request)
    {
        $items = $request->input('items'); // array of {id, name, qty, price}
        $total = collect($items)->sum(fn($item) => $item['qty'] * $item['price']);

        Sale::create([
            'items' => json_encode($items),
            'total' => $total,
        ]);

        return response()->json(['success' => true, 'message' => 'Sale recorded!', 'total' => $total]);
    }
}
