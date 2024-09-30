<?php

namespace App\Http\Controllers;

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
    public function create()
    {
        //
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
            
        }catch(\Exception $e){return $e->getMessage();}
        //
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $product = RecipetModel::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Recipet not found.');
        }
        return view('editDataIndex', ['product' => $product])->with('success', 'Product updated successfully.');;
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
        ]);
    
        $recipet->name_recipets = $request->name_recipets;
        $recipet->description_recipets = $request->description_recipets;
        $recipet->quantity_recipets = $request->quantity_recipets;
        $recipet->total_recipets = $request->total_recipets;
    
        $recipet->save();
    
        return redirect()->route('recipet.index')
        ->with('success', 'Recipet created successfully.');

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
}
