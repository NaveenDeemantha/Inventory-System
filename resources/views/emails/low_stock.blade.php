@extends('emails.layout')

@section('content')
    <div style="text-align: center; margin-bottom: 24px;">
        <span class="alert-badge alert-warning">Low Stock Alert</span>
    </div>

    <p>Hello Admin,</p>

    <p>The following inventory item has dropped below the minimum stock threshold:</p>

    <table class="table">
        <tr>
            <th>Product Name</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>SKU</th>
            <td>{{ $product->sku }}</td>
        </tr>
        <tr>
            <th>Current Quantity</th>
            <td style="color: #E74833; font-weight: bold;">{{ $product->quantity }}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $product->category->name ?? 'N/A' }}</td>
        </tr>
    </table>

    <p>Please arrange for restocking as soon as possible to avoid stockouts.</p>

    <div style="text-align: center;">
        <a href="{{ route('products.edit', $product->id) }}" class="button">Restock Now</a>
    </div>
@endsection
