<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            // 
            'productName' => $row[0],
            'product_categories_id' => $row[1],
            'suppliers_id' => $row[2],
            'productCode' => $row[3],
            'productImage' => $row[4],
            'productStock' => $row[5],
            'buyingDate' => $row[6],
            'expireDate' => $row[7],
            'buyingPrice' => $row[8],
            'sellingPrice' => $row[9],
        ]);
    }
}
