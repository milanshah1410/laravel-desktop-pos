<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function exportInvoicePDF($id)
    {
        $sale = Sale::with('items.product', 'customer')->findOrFail($id);
        $pdf = Pdf::loadView('pdf.invoice', compact('sale'));
        return $pdf->download("Invoice-#{$sale->id}.pdf");
    }
}
