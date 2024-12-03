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
            'categoryID' => $row[1],
            'supplierID' => $row[2],
            'productCode' => $row[3],
            'productImage' => $row[4],
            'buyingDate' => $row[5],
            'expireDate' => $row[6],
            'buyingPrice' => $row[7],
            'sellingPrice' => $row[8],
        ]);
    }
}
