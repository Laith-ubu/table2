<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use Yajra\DataTables\DataTables;

class productController extends Controller
{
    public function showAddForm()
    {
        return redirect('/addNeww');
    }
    public function add(Request $request){
        
        try{
            $request->validate([
                'name_product' => 'required|string',
                'description_product' => 'nullable|string',
                'price_product' => 'required|numeric',
                'status_product' => 'nullable|string',
            ]);
    
            $attributes = $request->only('name_product', 'description_product', 'price_product', 'status_product');
            $attributes['status_product'] = $request->has('status_product') ? 'Available' : 'Not Available';

            ProductModel::create($attributes);
            return redirect('/products')->with('success', 'Product Created successfully.');;

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function index(){
        $products = ProductModel::all();
        return view('products/products',compact('products'));
    }
    public function editOrUpdate(Request $request)
    {

        if ($request->isMethod('put')) {

            $product = ProductModel::findOrFail($request->id);
            $request->validate([
                'id' => 'required|integer|exists:products,id',
                'name_product' => 'required|string|max:255',
                'description_product' => 'nullable|string',
                'price_product' => 'required|numeric',
                'status_product' => 'nullable|string|in:Available,Not Available',
            ]);

            $product->update(array_merge(
                $request->only(['name_product', 'description_product', 'price_product']),
                ['status_product' => $request->has('status_product') ? 'Available' : 'Not Available']
            ));
            return redirect()->route('products')->with('success', 'Product updated successfully.');
        
        } else {

            $product = ProductModel::findOrFail($request->id);
            return view('products/editData', ['product' => $product]);
        }
    }
    public function delete(Request $request) 
    {
        $product = ProductModel::findOrFail($request->id);
        $product->delete();
        return redirect()->route('products')->with('success', 'Your row has been deleted successfully!');
    }
    public function getProducts()
    {
        return ProductModel::getData();
    }
    public function getProductsName()
    {
        $products = ProductModel::select('id','name_product')->get();
        return response()->json($products);
    }
}
