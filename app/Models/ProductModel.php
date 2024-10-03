<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name_product', 'description_product', 'price_product', 'status_product'];

    public function recipets()
    {
        return $this->belongsToMany(RecipetModel::class, 'recipets_select', 'product_id', 'recipet_id');
    }
}
