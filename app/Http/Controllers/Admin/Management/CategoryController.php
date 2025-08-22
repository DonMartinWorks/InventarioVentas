<?php

namespace App\Http\Controllers\Admin\Management;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.management.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.management.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'min:2', 'unique:categories,name'],
            'description' => ['nullable', 'string', 'max:1000']
        ]);

        $category = Category::create($data);

        # Toast Message
        session()->flash('swal', [
            'title' => __("Created"),
            'text' => __(":name has been created", ['name' => $request->name]),
            'icon' => "success"
        ]);

        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('admin.management.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'min:2', 'unique:categories,name,' . $category->id],
            'description' => ['nullable', 'string', 'max:1000']
        ]);

        $category->update($data);

        # Toast Message
        session()->flash('swal', [
            'title' => __("Updated"),
            'text' => __(":name has been updated", ['name' => $request->name]),
            'icon' => "success"
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse|Response
    {
        try {
            $category->delete();

            // $this->deletedNotification($role->name);
            session()->flash('swal', [
            'title' => __("Deleted"),
            'text' => __(":name has been deleted", ['name' => $category->name]),
            'icon' => "warning"
        ]);

            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            // Log the error to Laravel's log file
            Log::error('Error deleting :name', ['name' => $category->name . ' ' . $e->getMessage()]);

            // Return an error response to the AJAX request
            return response(['status' => 'error', 'message' => __('Failed to delete :name. Please try again later.', ['name' => __('role')])], 500);
        }
    }
}
