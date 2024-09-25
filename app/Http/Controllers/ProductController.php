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
}