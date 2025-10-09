<?php

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

/**
 * Route::get('/user', function (Request $request) {
 *     return $request->user();
 * })->middleware('auth:sanctum');
 */

Route::post('/suppliers', function (Request $request) {
    return Supplier::select('id', 'name')
        ->when($request->search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('document_number', 'like', "%{$search}%");
        })
        ->when(
            $request->exists('selected'),
            fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
            fn(Builder $query) => $query->limit(10)
        )
        ->orderBy('name', 'ASC')
        ->get();
})->name('api.suppliers.index');

Route::post('/products', function (Request $request) {
    return Product::select('id', 'name')
        ->when($request->search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%")
                ->orWhere('bar_code', 'like', "%{$search}%");
        })
        ->when(
            $request->exists('selected'),
            fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
            fn(Builder $query) => $query->limit(10)
        )
        ->orderBy('name', 'ASC')
        ->get();
})->name('api.products.index');

Route::get('/purchase-orders', function (Request $request) {
    $purchaseOrder = PurchaseOrder::when($request->search, function ($query, $search) {
        $parts = explode('-', $search);

        if (count($parts) == 1) {
            $query->whereHas('supplier', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('document_number', 'like', "%{$search}%");
            });

            return;
        }

        if (count($parts) !== 2) {
            return;
        }

        $series = $parts[0];
        $correlative = ltrim($parts[1], '0');

        $query->where('series', $series)
            ->where('correlative', 'LIKE', "%{$correlative}%");
    })
        ->when(
            $request->exists('selected'),
            fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
            fn(Builder $query) => $query->limit(10)
        )
        ->with(['supplier'])
        ->orderBy('series', 'ASC')
        ->get();

    return $purchaseOrder->map(function ($purchaseOrder) {
        return [
            'id' => $purchaseOrder->id,
            'name' => $purchaseOrder->series . '-' . $purchaseOrder->correlative,
            'description' => $purchaseOrder->supplier->name
        ];
    });
})->name('api.purchase-orders.index');
