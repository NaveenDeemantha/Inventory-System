<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProductImportController extends Controller
{
    public function index()
    {
        return Inertia::render('Import/Index');
    }

    public function search(Request $request)
    {
        $query = strtolower($request->input('query'));
        
        // Load local catalog
        $jsonPath = resource_path('data/industrial_catalog.json');
        if (!file_exists($jsonPath)) {
            return response()->json(['products' => []]);
        }
        
        $catalog = json_decode(file_get_contents($jsonPath), true);
        
        // Filter results
        $results = array_filter($catalog, function ($item) use ($query) {
            if (empty($query)) return true; // Return all if no query
            
            return str_contains(strtolower($item['title']), $query) || 
                   str_contains(strtolower($item['description']), $query) ||
                   str_contains(strtolower($item['category']), $query);
        });

        // Re-index array to be a clean JSON list
        return response()->json(['products' => array_values($results)]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'thumbnail' => 'nullable|url',
            'category' => 'nullable|string',
            'brand' => 'nullable|string',
        ]);

        // Find or create category
        $category = null;
        if (!empty($data['category'])) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($data['category'])],
                ['name' => Str::title($data['category'])]
            );
        }

        // Create Product
        $product = Product::create([
            'name' => $data['title'],
            'sku' => 'IMP-' . Str::upper(Str::random(8)), // Generate a random SKU
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['stock'],
            'image' => $data['thumbnail'],
            'category_id' => $category ? $category->id : null,
        ]);

        return redirect()->back()->with('success', 'Product imported successfully!');
    }
}
