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

    public function ProductCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_categories_id', 'id');
    } //end method category

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class, 'suppliers_id', 'id');
    } //end method supplier

}
