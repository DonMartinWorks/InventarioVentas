<?php

namespace App\Http\Controllers\Admin\Management;

use App\Models\Identity;
use App\Models\Supplier;
use Illuminate\View\View;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Traits\SweetAlertNotifications;

class SupplierController extends Controller
{
    use SweetAlertNotifications;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.management.suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $identities = Identity::orderBy('id', 'ASC')->get();

        return view('admin.management.suppliers.create', compact('identities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'identity_id' => ['required', 'exists:identities,id'],
            'document_number' => ['required', 'string', 'max:20', 'unique:suppliers,document_number'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:suppliers,email'],
            'address' => ['nullable', 'string', 'max:300'],
            'phone' => ['nullable', 'string', 'max:18', 'unique:suppliers,phone', new PhoneNumber],
        ]);

        $supplier = Supplier::create($data);

        # Toast Message
        $this->createdNotification(__('Supplier'));

        return redirect()->route('admin.suppliers.edit', $supplier);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier): View
    {
        $identities = Identity::orderBy('id', 'ASC')->get();

        return view('admin.management.suppliers.edit', compact('supplier', 'identities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $data = $request->validate([
            'identity_id' => ['required', 'exists:identities,id'],
            'document_number' => ['required', 'string', 'max:20', 'unique:suppliers,document_number,' . $supplier->id],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:suppliers,email,' . $supplier->id],
            'address' => ['nullable', 'string', 'max:300'],
            'phone' => ['nullable', 'string', 'max:18', 'unique:suppliers,phone,' . $supplier->id, new PhoneNumber],
        ]);

        $supplier->update($data);

        # Toast Message
        $this->updatedNotification($request->name);

        return redirect()->route('admin.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier): RedirectResponse|Response
    {
        if ($supplier->purchaseOrders()->exists() || $supplier->purchases()->exists()) {
            $this->errorNotification('Error!', 'The supplier cannot be deleted because he has purchase or orders associated with him.');
        }

        try {
            $supplier->delete();

            $this->deletedNotification($supplier->name);

            return redirect()->route('admin.suppliers.index');
        } catch (\Exception $e) {
            // Log the error to Laravel's log file
            Log::error('Error deleting :name', ['name' => $supplier->name . ' ' . $e->getMessage()]);

            // Return an error response to the AJAX request
            return response(['status' => 'error', 'message' => __('Failed to delete :name. Please try again later.', ['name' => __('Supplier')])], 500);
        }
    }
}
