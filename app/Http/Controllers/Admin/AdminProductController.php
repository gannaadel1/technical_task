<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('Admin.admin', compact('products'));
    }

    // Show the edit form for a product
    public function edit(Product $product)
    {
        return view('Admin.edit', compact('product'));
    }

    // Update a product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|integer',
        ]);

        $product->update($request->all());

        return redirect()->route('Admin.admin')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('Admin.admin')->with('success', 'Product deleted successfully.');
    }
}
