<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // GET: Retrieve all products
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // GET: Retrieve a single product by ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    // POST: Create a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:company,id',
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    // PUT: Update an existing product by ID
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'company_id' => 'sometimes|required|exists:company,id',
            'name' => 'sometimes|required|string|max:255',
            'icon' => 'sometimes|required|string|max:255',
        ]);

        $product->update($validated);
        return response()->json($product, 200);
    }

    // DELETE: Delete a product by ID
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}
