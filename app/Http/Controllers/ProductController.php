<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return \Inertia\Inertia::render('Inventory/Index', [
            'products' => \App\Models\Product::all(),
        ]);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Inventory/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        \App\Models\Product::create($validated);

        return redirect()->route('products.index');
    }

    public function edit(\App\Models\Product $product)
    {
        return \Inertia\Inertia::render('Inventory/Edit', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, \App\Models\Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);

        return redirect()->route('products.index');
    }

    public function destroy(\App\Models\Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
