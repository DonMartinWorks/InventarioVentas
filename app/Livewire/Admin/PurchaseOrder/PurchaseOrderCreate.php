<?php

namespace App\Livewire\Admin\PurchaseOrder;

use App\Models\Product;
use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\PurchaseOrder;
use function Laravel\Prompts\warning; // This function is unused, can be kept or removed
use App\Traits\SweetAlertNotifications;

/**
 * Livewire component for creating new Purchase Orders.
 */
class PurchaseOrderCreate extends Component
{
    // Use a custom trait for displaying SweetAlert notifications
    use SweetAlertNotifications;

    // Public properties that hold form data
    public $product_id;         // ID of the product currently being added
    public $supplier_id;        // ID of the selected supplier
    public $voucher_type = '';  // Type of voucher (e.g., '1' for Invoice, '2' for Receipt)
    public $series = 'OC01';    // Default series code for the Purchase Order
    public $correlative;        // The sequential correlative number for the PO
    public $date;               // The date of the Purchase Order
    public $total = 0;          // Calculated total amount of the Purchase Order
    public $observations = null;// Optional notes or observations

    /**
     * Array to hold the list of products added to the purchase order.
     * Structure: ['id' => int, 'name' => string, 'quantity' => int, 'price' => float, 'subtotal' => float]
     */
    public $products = [];

    /**
     * Livewire lifecycle hook: Runs immediately after a component is instantiated.
     * Used here to register a validation failure callback to display errors via SweetAlert.
     */
    public function boot()
    {
        // Register a callback to execute if validation fails
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();

                $html = "<ul class='text-left' style='text-red'>";

                // Iterate through validation errors to format them into an HTML list
                foreach ($errors as $error) {
                    $html .= "<li>{$error[0]}</li>";
                }

                $html .= "</ul>";

                // Dispatch error notification via SweetAlert
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => __('Validation Error'),
                    'html' => $html
                ]);
            }
        });
    }

    /**
     * Adds a selected product to the temporary products list.
     * It validates the product ID and checks for duplicates.
     */
    public function addProduct()
    {
        // Validate that a product ID has been selected and exists in the database
        $this->validate([
            'product_id' => ['required', 'exists:products,id']
        ], [], [
            'product_id' => Str::lower(__('Product')) // Custom attribute name for cleaner messages
        ]);

        // Check if the product is already in the temporary list
        $existing = collect($this->products)
            ->firstWhere('id', $this->product_id);

        // Fetch the product details from the database
        $product = Product::find($this->product_id);

        // If the product is already listed, show a warning notification and exit
        if ($existing) {
            $this->dispatch('swal', [
                'icon' => 'warning',
                'title' => __('Duplicated'),
                'text' => __(':name duplicated!', ['name' => $product->name])
            ]);

            return;
        }

        // Add the new product to the list with default quantity and price
        $this->products[] = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => 0, // Default to 0, expecting user to update price
            'subtotal' => 0
        ];

        // Clear the product selection field for the next addition
        $this->reset('product_id');
    }

    /**
     * Handles the creation of the Purchase Order and its associated products.
     */
    public function save()
    {
        // Validate all necessary fields for the Purchase Order header and product lines
        $this->validate([
            'voucher_type' => ['required', 'in:1,2'],
            'date' => ['nullable', 'date'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'total' => ['required', 'numeric', 'min:0'],
            'observations' => ['nullable', 'string', 'max:500'],
            'products' => ['required', 'array', 'min:1'], // Must have at least one product
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'numeric', 'min:1'],
            'products.*.price' => ['required', 'numeric', 'min:0']
        ]);

        // Create the Purchase Order record in the database
        $purchaseOrder = PurchaseOrder::create([
            'voucher_type' => $this->voucher_type,
            'series' => $this->series,
            'correlative' => $this->correlative,
            'date' => $this->date ?? now(), // Use current date if no date is provided
            'supplier_id' => $this->supplier_id,
            'total' => $this->total,
            'observations' => $this->observations,
        ]);

        // Attach each product to the newly created Purchase Order using the pivot table
        foreach ($this->products as $product) {
            $purchaseOrder->products()->attach(
                $product['id'],
                [
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    // Calculate and store the subtotal on the pivot table
                    'subtotal' => $product['quantity'] * $product['price'],
                ]
            );
        }

        // Dispatch success notification via SweetAlert
        $this->createdNotification(__('Purchase Order'));

        // Redirect the user to the Purchase Orders index page
        return redirect()->route('admin.purchase-orders.index');
    }

    /**
     * Livewire lifecycle hook: Runs once immediately after the component is instantiated.
     * Used here to initialize the correlative number.
     */
    public function mount()
    {
        // Get the maximum existing correlative number and increment it by 1 for the new PO
        $this->correlative = PurchaseOrder::max('correlative') + 1;
    }

    /**
     * Renders the view for the component.
     */
    public function render(): View
    {
        return view('livewire.admin.purchase-order.purchase-order-create');
    }
}
