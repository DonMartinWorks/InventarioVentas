<?php

namespace App\Livewire\Admin\PurchaseOrder;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\PurchaseOrder;
use App\Traits\SweetAlertNotifications;
use function Laravel\Prompts\warning;

class PurchaseOrderCreate extends Component
{
    use SweetAlertNotifications;

    public $product_id;

    public $supplier_id;

    public $voucher_type = '';

    public $series = 'OC01';

    public $correlative;

    public $date;

    public $total = 0;

    public $observations = null;

    public $products = [];

    public function save()
    {
        //
    }

    public function addProduct()
    {
        $this->validate([
            'product_id' => ['required', 'exists:products,id']
        ], [], [
            'product_id' => Str::lower(__('Product'))
        ]);

        $existing = collect($this->products)
            ->firstWhere('id', $this->product_id);

        $product = Product::find($this->product_id);

        if ($existing) {
            $this->dispatch('swal', [
                'icon' => 'warning',
                'title' => __('Duplicated'),
                'text' => __(':name duplicated!', ['name' => $product->name])
            ]);

            return;
        }

        $this->products[] = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => 0,
            'subtotal' => 0
        ];

        $this->reset('product_id');
    }

    public function mount()
    {
        $this->correlative = PurchaseOrder::max('correlative') + 1;
    }

    public function render()
    {
        return view('livewire.admin.purchase-order.purchase-order-create');
    }
}
