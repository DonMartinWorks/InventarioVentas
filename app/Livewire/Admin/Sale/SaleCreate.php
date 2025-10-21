<?php

namespace App\Livewire\Admin\Sale;

use App\Models\Product;
use App\Models\Quote;
use App\Models\Sale;
use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Traits\SweetAlertNotifications;

class SaleCreate extends Component
{
    // Use a custom trait for displaying SweetAlert notifications
    use SweetAlertNotifications;

    // Public properties that hold form data
    public $product_id;            // ID of the product currently being added
    public $customer_id;           // ID of the selected customer
    public $warehouse_id;          // ID of the selected warehouse
    public $voucher_type = '';     // Type of voucher (e.g., '1' for Invoice, '2' for Receipt)
    public $series = 'F001';           // Default series code for the Sale
    public $correlative;           // The sequential correlative number for the PO
    public $date;                  // The date of the Sale
    public $quote_id;     // ID of the Quote
    public $total = 0;             // Calculated total amount of the Sale
    public $observation = null;   // Optional notes or observation

    /**
     * Array to hold the list of products added to the Sale.
     * Structure: ['id' => int, 'name' => string, 'quantity' => int, 'price' => float, 'subtotal' => float]
     */
    public $products = [];

    /**
     * Livewire lifecycle hook: Runs immediately after a component is instantiated.
     * Used here to register a validation failure callback to display errors via SweetAlert.
     */
    public function boot(): void
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
    public function addProduct(): void
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
            'price' => $product->price,
            'subtotal' => $product->price
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
            'series' => ['required', 'string', 'max:10'],
            'correlative' => ['required', 'numeric', 'min:1'],
            'date' => ['nullable', 'date'],
            'quote_id' => ['nullable', 'exists:quotes,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'warehouse_id' => ['required', 'exists:warehouses,id'],
            'total' => ['required', 'numeric', 'min:0'],
            'observation' => ['nullable', 'string', 'max:500'],
            'products' => ['required', 'array', 'min:1'], // Must have at least one product
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.quantity' => ['required', 'numeric', 'min:1'],
            'products.*.price' => ['required', 'numeric', 'min:0']
        ]);

        // Create the Purchase Order record in the database
        $sale = Sale::create([
            'voucher_type' => $this->voucher_type,
            'series' => Str::upper($this->series),
            'correlative' => Str::upper($this->correlative),
            'date' => $this->date ?? now(), // Use current date if no date is provided
            'quote_id' => $this->quote_id,
            'customer_id' => $this->customer_id,
            'warehouse_id' => $this->warehouse_id,
            'total' => $this->total,
            'observation' => $this->observation,
        ]);

        // Attach each product to the newly created Sale Order using the pivot table
        foreach ($this->products as $product) {
            $sale->products()->attach(
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
        $this->createdNotification(__('Sale'));

        // Redirect the user to the Purchase Orders index page
        return redirect()->route('admin.sales.index');
    }

    /**
     * Livewire hook: Runs when a public property is updated.
     * Used here to load data from an existing Purchase Order if 'purchase_order_id' changes.
     *
     * @param string $property The name of the property that was updated.
     * @param ?string $value The new value of the property.
     * @return void
     */
    public function updated(string $property, ?string $value): void
    {
        // Check if the updated property is the quote_id
        if ($property == 'quote_id') {
            // Find the Purchase Order record using the provided ID
            $quote = Quote::find($value);

            if ($quote) {
                // If a Purchase Order is found, populate the form fields with its data
                $this->voucher_type = $quote->voucher_type;
                $this->customer_id = $quote->customer_id;

                // Map the related products from the Purchase Order to the component's $products array
                $this->products = $quote->products->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        // Retrieve quantity, price, and subtotal from the pivot table relationship
                        'quantity' => $product->pivot->quantity,
                        'price' => $product->pivot->price,
                        'subtotal' => $product->pivot->subtotal,
                    ];
                })->toArray();
            }
        }
    }

    public function mount()
    {
        $this->correlative = Quote::max('correlative') + 1;
    }

    public function render(): View
    {
        return view('livewire.admin.sale.sale-create');
    }
}
