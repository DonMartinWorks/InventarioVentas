<?php

namespace App\Http\Controllers\Admin\Management;

use App\Models\Warehouse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SweetAlertNotifications;

class WarehouseController extends Controller
{
    use SweetAlertNotifications;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.management.warehouses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.management.warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150', 'min:2', 'unique:warehouses,name'],
            'location' => ['nullable', 'string', 'max:300']
        ]);

        $warehouse = Warehouse::create($data);

        # Toast Message
        $this->createdNotification(__('Warehouse'));

        return redirect()->route('admin.warehouses.edit', $warehouse);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        return view('admin.management.warehouses.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
