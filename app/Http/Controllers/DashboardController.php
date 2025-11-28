<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalValue = Product::sum(\DB::raw('price * quantity'));
        $lowStockItems = Product::where('quantity', '<', 10)->count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        // Chart Data: Inventory by Category
        $categories = Category::withCount('products')->get();
        $categoryLabels = $categories->pluck('name');
        $categoryData = $categories->pluck('products_count');

        // Chart Data: Stock Value by Category
        // This is a bit more complex, let's do a simple one first.
        // Let's get top 5 categories by product count for now.

        return Inertia::render('Dashboard', [
            'stats' => [
                'totalProducts' => $totalProducts,
                'totalValue' => number_format($totalValue, 2),
                'lowStockItems' => $lowStockItems,
                'totalCategories' => $totalCategories,
                'totalUsers' => $totalUsers,
            ],
            'charts' => [
                'inventoryByCategory' => [
                    'labels' => $categoryLabels,
                    'data' => $categoryData,
                ],
            ],
        ]);
    }
}
