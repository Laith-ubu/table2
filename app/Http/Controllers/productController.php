<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use Yajra\DataTables\DataTables;

class productController extends Controller
{
    public function add(Request $request){
        try{
            if($request->isMethod('post')){

                $request->validate([
                    'name_product' => 'required|string',
                    'description_product' => 'nullable|string',
                    'price_product' => 'required|numeric',
                ]);
                
                $attributes = $request->only('name_product', 'description_product', 'price_product', 'status_product');

                if (count($attributes) == 3) {
                    $attributes['status_product'] = 'Not Available';
                }
                
                ProductModel::create($attributes);
                return redirect('products');
            }
            else{
                echo 'Form not Submitted';
            }
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }public function index(){
        $products = ProductModel::latest()->paginate();
        return view('products',compact('products'));
    }
    public function edit(Request $request){
       
        $product = ProductModel::find($request->id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        return view('editData', ['product' => $product])->with('success', 'Product updated successfully.');;
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'name_product' => 'required|string|max:255',
            'description_product' => 'nullable|string',
            'price_product' => 'required|numeric',
            'status_product' => 'nullable|string|in:Available,Not Available',
        ]);
    
        $product = ProductModel::find($request->id);
        
        $product->name_product = $request->name_product;
        $product->description_product = $request->description_product;
        $product->price_product = $request->price_product;
        $product->status_product = $request->status_product ?? 'Not Available';
    
        $product->save();
        $products = ProductModel::all();
    
        // return view('products', ['products' => $products]);
        return redirect()->route('products')
                        ->with('success', 'Your message has been sent successfully!');

    }
    public function delete(Request $request) {

        $request->validate([
            'id' => 'required|integer|exists:products,id',
        ]);
    
        $product = ProductModel::find($request->id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $product->delete();
        $products = ProductModel::all();
    
        return view('products', ['products' => $products])->with('success', 'Product deleted successfully.');
    }
    

    public function getProducts()
    {
        $query = $this->getProductsQuery();
        return DataTables::of($query)
        ->make(true); 
    }


}
