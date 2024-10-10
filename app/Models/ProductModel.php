<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name_product', 'description_product', 'price_product', 'status_product'];
   
    public static function getData()
    {
        $query = self::query();
        return DataTables::of($query)->make(true);
    }
    public function recipets()
    {
        return $this->belongsToMany(RecipetModel::class, 'recipets_select', 'product_id', 'recipet_id');
    }
    public function getNameProductAttribute($value)
    {
        return ucfirst($value); 
    }
    public static function getProductNames()
    {
        return self::select('id', 'name_product')->get()->map(function($product) {
            return [
                'id' => $product->id,
                'name_product' => $product->name_product,
            ];
        });
    }
}
