<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * Return collection of data to export
    */
    public function collection()
    {
        return Product::all(['id', 'name', 'price', 'stock', 'created_at']); // select columns explicitly if needed
    }

    /**
    * Return headings for the columns
    */
    public function headings(): array
    {
        return [
            'ID',
            'Product Name',
            'Price',
            'Stock',
            'Created At',
        ];
    }
}
