<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\RecipetModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class recipetController extends Controller
{
    public function showAddForm()
    {
        return redirect('/addNewRecipett');
    }
    public function index()
    {
        $products = RecipetModel::all();
        return view('reciepets/reciepets',compact('products'));
    }
    public function store(Request $request)
    {
        try {
                $request->validate([
                    "name_recipets"=> "required|string",
                    "description_recipets"=> "nullable|string",
                    "quantity_recipets"=> "required|numeric",
                    "total_recipets"=> "required|numeric",
                ]);

                RecipetModel::create($request->all());
                return redirect('reciepets/reciepets');
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function editOrUpdate(Request $request, string $id)
    {
        if ($request->isMethod('post')) {

            $recipet = RecipetModel::findOrFail($id);

            $request->validate([
                "name_recipets" => "required|string",
                "description_recipets" => "nullable|string",
                "quantity_recipets" => "required|numeric",
                "total_recipets" => "required|numeric",
                "productSelect" => "required|array",
            ]);

            $recipet->update($request->only(['name_recipets', 'description_recipets', 'quantity_recipets', 'total_recipets']));

            return redirect()->route('recipet.index')
                ->with('success', 'Recipet updated successfully.');
        } else {
            $recipet = RecipetModel::findOrFail($id);

            $linkedProductIds = \DB::table('recipets_select')
                ->where('recipet_id', $recipet->id)
                ->pluck('product_id');
                
            $allProducts = ProductModel::all();

            return view('reciepets.editRecipet', [
                'product' => $recipet,
                'linkedProductIds' => $linkedProductIds,
                'allProducts' => $allProducts,
            ]);
        }
    }
    public function destroy(Request $request, string $id)
    {
        $recipet = RecipetModel::findOrFail($id);
        $recipet->delete();     
        return redirect()->route('recipet.index')->with('success', 'Recipet deleted successfully.');
    }
    public function getRecipets()
    {
        return RecipetModel::getData();
    }
    public function storeSelect(Request $request){
        try {
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

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
