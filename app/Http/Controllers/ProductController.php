<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    use ApiResponse;

    public function show($id)
    {
        return "The product is: " . $id;
    }
    public function index(Request $request)
    {
        $Page = $request->get('page', 5); 
        $products = Product::paginate($Page);

        return $this->apiResponse($products , 'Products retrieved Successfully' , 200) ;
    }


        public function store(Request $request)
{
    
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|integer|min:0',
        'category_id' => 'required|integer',
    ]);

    
    $product = Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'category_id' => $request->category_id,
    ]);

   
    return response()->json($product, 201);
}
    }
