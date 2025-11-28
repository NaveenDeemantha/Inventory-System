<?php

namespace App\Observers;

use App\Mail\LowStockAlert;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ProductObserver
{
    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        // Check if quantity changed and is now below threshold (10)
        // Also check if it was previously ABOVE or EQUAL to threshold to avoid spamming on every update below 10
        if ($product->isDirty('quantity') && $product->quantity < 10 && $product->getOriginal('quantity') >= 10) {
            // Find Super Admins
            $superAdmins = User::where('role', 'super_admin')->get();

            foreach ($superAdmins as $admin) {
                Mail::to($admin->email)->send(new LowStockAlert($product));
            }
        }
    }
}
