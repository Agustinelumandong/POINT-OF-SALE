<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'categoryID', 'id');
    } //end method category

    public function productSupplier()
    {
        return $this->belongsTo(Supplier::class, 'supplierID', 'id');
    } //end method supplier

}
