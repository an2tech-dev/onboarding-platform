<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;


class ProductController extends Controller
{
    public function __construct()
{
    $this->middleware(['role:Administrator|Manager'])->only(['index', 'show', 'store', 'destroy', 'update']);
}

    public function index()
    {
        if (auth()->user()->hasRole('Administrator')) {
            return response()->json(Product::all());
        } else {
            return response()->json(Product::where('company_id', auth()->user()->company_id)->get());
        }
    }
  
    
    public function store(StoreProductRequest $request)
{
    $data = $request->validated();
    \Log::info('Product data:', $data); 

    if (auth()->user()->hasRole('Manager')) {
        if ($data['company_id'] !== auth()->user()->company_id) {
            return response()->json(['error' => 'Unauthorized to create a product for this company'], 403);
        }
    }

    try {
        $product = Product::create($data);
        \Log::info('Product created:', $product->toArray()); 
        return response()->json($product, 201); 
    } catch (\Exception $e) {
        \Log::error('Product creation failed: ' . $e->getMessage());
        return response()->json(['error' => 'Product could not be created'], 500);
    }
}


public function update(UpdateProductRequest $request, $id)
{
    $data = $request->validated();
    \Log::info('Update Product data:', $data);

    $product = Product::findOrFail($id);

    if (auth()->user()->hasRole('Manager')) {
        if ($product->company_id !== auth()->user()->company_id) {
            return response()->json(['error' => 'Unauthorized to update this product'], 403);
        }
    }

    try {
        $product->update($data);
        \Log::info('Product updated:', $product->toArray());
        return response()->json($product);
    } catch (\Exception $e) {
        \Log::error('Product update failed: ' . $e->getMessage());
        return response()->json(['error' => 'Product could not be updated'], 500);
    }
}

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (auth()->user()->hasRole('Manager') && auth()->user()->company_id !== $product->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $product->delete();
        return response()->json(null, 204);
    }
}