<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipetModel extends Model
{
    use HasFactory;

    protected $table = "recipets";
    protected $fillable = ["name_recipets","description_recipets","quantity_recipets","total_recipets"];
    public function products()
    {
        return $this->belongsToMany(ProductModel::class, 'recipets_select', 'recipet_id', 'product_id');
    }
}
