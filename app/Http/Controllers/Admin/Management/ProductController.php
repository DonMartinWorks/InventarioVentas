<?php

namespace App\Http\Controllers\Admin\Management;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Traits\SweetAlertNotifications;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use SweetAlertNotifications;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.management.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.management.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $product = Product::create($data);

        # Toast Message
        $this->createdNotification(__('Product'));

        return redirect()->route('admin.products.edit', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.management.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $product->update($data);

        # Toast Message
        $this->updatedNotification($request->name);

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse|Response
    {
        if ($product->inventories()->exists()) {
            $this->errorNotification(
                __(':name Exists!', ['name' => __('Inventory')]),
                __('The product cannot be deleted because there is associated inventory.'),
                10000
            );

            return redirect()->route('admin.products.index');
        }

        if ($product->purchaseOrders()->exists() || $product->quotes()->exists()) {
            $this->errorNotification(
                __(':name Exists!', ['name' => __('Product')]),
                __('The product cannot be deleted because it has no purchase orders or any associated quotes.'),
                10000
            );

            return redirect()->route('admin.products.index');
        }

        try {
            $product->delete();

            $this->deletedNotification($product->name);

            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            // Log the error to Laravel's log file
            Log::error('Error deleting :name', ['name' => $product->name . ' ' . $e->getMessage()]);

            // Return an error response to the AJAX request
            return response(['status' => 'error', 'message' => __('Failed to delete :name. Please try again later.', ['name' => __('product')])], 500);
        }
    }

    /**
     * Store the image form.
     */
    public function dropzone(Request $request, Product $product): JsonResponse
    {
        $disk = '/images/products';

        $image = $product->images()->create([
            'path' => Storage::put($disk, $request->file('file')),
            'size' => $request->file('file')->getSize()
        ]);

        return response()->json([
            'path' => $image->path
        ]);
    }
}
