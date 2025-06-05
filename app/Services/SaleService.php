<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;

class SaleService
{
    public function checkout(array $cart, float $discount = 0, float $paidAmount = null, int $customerId): Sale
    {
        return DB::transaction(function () use ($cart, $discount, $paidAmount, $customerId) {
            $subtotal = collect($cart)->sum(fn($item) => $item['qty'] * $item['price']);
            $total = $subtotal - $discount;
            $paidAmount = $paidAmount ?? $total;

            $sale = Sale::create([
                'customer_id' => $customerId, // ✅ required for integrity
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'paid' => $paidAmount,
            ]);

            foreach ($cart as $productId => $item) {
                $product = Product::findOrFail($productId);
                $product->decrement('stock', $item['qty']);

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $item['qty'],
                    'unit_price' => $item['price'],
                    'total_price' => $item['qty'] * $item['price'],
                ]);
            }

            return $sale;
        });
    }
}
