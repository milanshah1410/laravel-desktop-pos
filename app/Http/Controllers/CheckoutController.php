<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\CustomerService;
use App\Services\SaleService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected SaleService $saleService,
        protected CustomerService $customerService
    ) {}

    public function checkoutForm()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->total();
        return view('cart.checkout', compact('cart', 'total'));
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'discount' => 'nullable|numeric|min:0',
            'paid' => 'required|numeric|min:0',
        ]);

        $cart = $this->cartService->getCart();
        if (empty($cart)) return back()->with('error', 'Cart is empty');

        $customer = $this->customerService->getOrCreate($validated['name'], $validated['mobile']);

        $sale = $this->saleService->checkout(
            $cart,
            $validated['discount'],
            $validated['paid'],
            $customer->id // ✅ pass customer ID here
        );

        $this->cartService->clear();

        return view('cart.invoice', compact('sale'));
    }
}
