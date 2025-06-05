<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getCart(): array
    {
        return Session::get('cart', []);
    }

    public function add(Product $product, int $qty): void
    {
        $cart = $this->getCart();

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
            ];
        }

        Session::put('cart', $cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        Session::put('cart', $cart);
    }

    public function clear(): void
    {
        Session::forget('cart');
    }

    public function total(): float
    {
        return collect($this->getCart())->sum(fn($item) => $item['qty'] * $item['price']);
    }
}
