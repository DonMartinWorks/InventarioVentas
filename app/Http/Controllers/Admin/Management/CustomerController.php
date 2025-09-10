<?php

namespace App\Http\Controllers\Admin\Management;

use App\Models\Customer;
use App\Models\Identity;
use Illuminate\View\View;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Traits\SweetAlertNotifications;

class CustomerController extends Controller
{
    use SweetAlertNotifications;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.management.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $identities = Identity::orderBy('id', 'ASC')->get();

        return view('admin.management.customers.create', compact('identities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'identity_id' => ['required', 'exists:identities,id'],
            'document_number' => ['required', 'string', 'max:20', 'unique:customers,document_number'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:customers,email'],
            'address' => ['nullable', 'string', 'max:300'],
            'phone' => ['nullable', 'string', 'max:18', 'unique:customers,phone', new PhoneNumber],
        ]);

        $customer = Customer::create($data);

        # Toast Message
        $this->createdNotification(__('Customer'));

        return redirect()->route('admin.customers.edit', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): View
    {
        $identities = Identity::orderBy('id', 'ASC')->get();

        return view('admin.management.customers.edit', compact('customer', 'identities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $data = $request->validate([
            'identity_id' => ['required', 'exists:identities,id'],
            'document_number' => ['required', 'string', 'max:20', 'unique:customers,document_number,' . $customer->id],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:customers,email,' . $customer->id],
            'address' => ['nullable', 'string', 'max:300'],
            'phone' => ['nullable', 'string', 'max:18', 'unique:customers,phone,' . $customer->id, new PhoneNumber],
        ]);

        $customer->update($data);

        # Toast Message
        $this->updatedNotification($request->name);

        return redirect()->route('admin.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse|Response
    {
        if ($customer->quotes()->exists() || $customer->sales()->exists()) {
            $this->errorNotification('Error!', 'The customer cannot be deleted because he has quotes or sales associated with him.');
        }

        try {
            $customer->delete();

            $this->deletedNotification($customer->name);

            return redirect()->route('admin.customers.index');
        } catch (\Exception $e) {
            // Log the error to Laravel's log file
            Log::error('Error deleting :name', ['name' => $customer->name . ' ' . $e->getMessage()]);

            // Return an error response to the AJAX request
            return response(['status' => 'error', 'message' => __('Failed to delete :name. Please try again later.', ['name' => __('Customer')])], 500);
        }
    }
}
