<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\RecipetModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class recipetController extends Controller
{
    public function index()
    {
        $products = RecipetModel::latest()->paginate();
        return view('index',compact('products'));
    }
    public function store(Request $request)
    {
        try {
            if ($request->isMethod("POST")) {

                $request->validate([
                    "name_recipets"=> "required|string",
                    "description_recipets"=> "nullable|string",
                    "quantity_recipets"=> "required|numeric",
                    "total_recipets"=> "required|numeric",
                ]);

                $atr=$request->only('name_recipets','description_recipets','quantity_recipets','total_recipets');
                
                var_dump($atr);
                RecipetModel::create($request->all());
                return redirect('index');
                
            }else{
                return 'Method is Not POST/Controller';
            }
            
        }catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }
    public function edit(string $id)
    {  
        $recipet = RecipetModel::find($id);

    if (!$recipet) {
        return redirect()->back()->with('error', 'Recipet not found.');
    }

    $linkedProductIds = \DB::table('recipets_select') // Get the linked product IDs
        ->where('recipet_id', $recipet->id)
        ->pluck('product_id');

    // Get all products
    $allProducts = ProductModel::all();

    return view('editDataIndex', [
        'product' => $recipet,
        'linkedProductIds' => $linkedProductIds,
        'allProducts' => $allProducts,
    ]);
     }
    public function update(Request $request, string $id)
    {
            $recipet = RecipetModel::find($id);
        if (!$recipet) {
            return redirect()->back()->with('error', 'Recipet not found.');
        }

        $request->validate([
            "name_recipets" => "required|string",
            "description_recipets" => "nullable|string",
            "quantity_recipets" => "required|numeric",
            "total_recipets" => "required|numeric",
            "productSelect" => "required|array",
        ]);

        $recipet->name_recipets = $request->name_recipets;
        $recipet->description_recipets = $request->description_recipets;
        $recipet->quantity_recipets = $request->quantity_recipets;
        $recipet->total_recipets = $request->total_recipets;

        $recipet->save();

        $recipet->products()->sync($request->productSelect);

        return redirect()->route('recipet.index')
            ->with('success', 'Recipet updated successfully.');
    }
    public function destroy(Request $request, string $id)
    {
        $recipet = RecipetModel::find($id);
        if (!$recipet) {
            return redirect()->back()->with('error', 'Recipet not found.');
        }
    
        $recipet->delete();
        
        return redirect()->route('recipet.index')->with('success', 'Recipet deleted successfully.');
    }
    public function getRecipets()
    {
        $query = RecipetModel::query();
        return DataTables::of($query)
        ->make(true); 
    }
    public function storeSelect(Request $request){
        try {
            if ($request->isMethod('post')) {
               
                $request->validate([
                    "name_recipets" => "required|string",
                    "description_recipets" => "nullable|string",
                    "quantity_recipets" => "required|numeric",
                    "total_recipets" => "required|numeric",
                    "productSelect" => "required|array",
                ]);
        
                $recipetData = $request->only('name_recipets', 'description_recipets', 'quantity_recipets', 'total_recipets');
                
                $recipet = RecipetModel::create($recipetData);
         
                $recipet->products()->attach($request->productSelect);
     
                return redirect('index')->with('success', 'Recipet created successfully.');        
             }
            else{
                return 'method is not post ';
            }

        }catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }
}
