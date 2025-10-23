<?php

use App\Models\Customer;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Models\Reason;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

/**
 * Route::get('/user', function (Request $request) {
 *     return $request->user();
 * })->middleware('auth:sanctum');
 */

Route::post('/warehouses', function (Request $request) {
    return Warehouse::select('id', 'name', 'location as description')
        ->when($request->search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
        })
        ->when(
            $request->exists('selected'),
            fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
            fn(Builder $query) => $query->limit(10)
        )
        ->orderBy('name', 'ASC')
        ->get();
})->name('api.warehouses.index');


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


Route::post('/customers', function (Request $request) {
    return Customer::select('id', 'name')
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
})->name('api.customers.index');


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


Route::post('/purchase-orders', function (Request $request) {
    $purchaseOrder = PurchaseOrder::when($request->search, function ($query, $search) {
        $parts = explode('-', $search);

        if (count($parts) == 1) {
            $query->whereHas('supplier', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('document_number', 'like', "%{$search}%");
            });

            return;
        }

        if (count($parts) == 2) {
            $series = $parts[0];
            $correlative = ltrim($parts[1], '0');

            $query->where('series', $series)
                ->where('correlative', 'LIKE', "%{$correlative}%");

            return;
        }
    })
        ->when(
            $request->exists('selected'),
            fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
            fn(Builder $query) => $query->limit(10)
        )
        ->with(['supplier'])
        ->orderBy('created_at', 'DESC')
        ->get();

    return $purchaseOrder->map(function ($purchaseOrder) {
        return [
            'id' => $purchaseOrder->id,
            'name' => $purchaseOrder->series . '-' . $purchaseOrder->correlative,
            'description' => $purchaseOrder->supplier->name . ' - ' . $purchaseOrder->supplier->document_number
        ];
    });
})->name('api.purchase-orders.index');


Route::post('/quotes', function (Request $request) {
    $quotes = Quote::when($request->search, function ($query, $search) {
        $parts = explode('-', $search);

        if (count($parts) == 1) {
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('document_number', 'like', "%{$search}%");
            });

            return;
        }

        if (count($parts) == 2) {
            $series = $parts[0];
            $correlative = ltrim($parts[1], '0');

            $query->where('series', $series)
                ->where('correlative', 'LIKE', "%{$correlative}%");

            return;
        }
    })
        ->when(
            $request->exists('selected'),
            fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
            fn(Builder $query) => $query->limit(10)
        )
        ->with(['customer'])
        ->orderBy('created_at', 'DESC')
        ->get();

    return $quotes->map(function ($quote) {
        return [
            'id' => $quote->id,
            'name' => $quote->series . '-' . $quote->correlative,
            'description' => $quote->customer->name . ' - ' . $quote->customer->document_number
        ];
    });
})->name('api.quotes.index');


Route::post('/reasons', function (Request $request) {
    return Reason::select('id', 'name')
        ->when($request->search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->when(
            $request->exists('selected'),
            fn(Builder $query) => $query->whereIn('id', $request->input('selected', [])),
            fn(Builder $query) => $query->limit(10)
        )
        ->where('type', $request->input('type', ''))
        ->orderBy('name', 'ASC')
        ->get();
})->name('api.reasons.index');
