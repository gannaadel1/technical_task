<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WebProductController extends Controller
{
    public Function index() 
    {
        $products = Product::all() ;
        return view('product', compact('products')) ;
    }

    public Function create() 
    {
        return view('addproduct') ;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer', 
            'category_id' => 'required|integer', 
        ]);
    
        
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);
    
        return redirect()->back()->with('success', 'New Product Added Successfully');
    }
    
}
