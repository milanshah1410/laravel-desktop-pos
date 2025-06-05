<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService) {}

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->total();
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $this->cartService->add($product, $request->qty);
        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $this->cartService->remove($id);
        return redirect()->route('cart.index');
    }

    public function clear()
    {
        $this->cartService->clear();
        return redirect()->route('cart.index');
    }
}
