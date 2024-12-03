<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::select('productName', 'categoryID', 'supplierID', 'productCode', 'productImage', 'buyingDate', 'expireDate', 'buyingPrice', 'sellingPrice')->get();
    }
}
