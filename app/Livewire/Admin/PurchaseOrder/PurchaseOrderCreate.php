<?php

namespace App\Livewire\Admin\PurchaseOrder;

use App\Models\PurchaseOrder;
use Livewire\Component;

class PurchaseOrderCreate extends Component
{
    public $product_id;

    public $supplier_id;

    public $voucher_type = '';

    public $series = 'OC01';

    public $correlative;

    public $date;

    public $total = 0;

    public $observations = null;

    public $products = [];

    public function mount()
    {
        $this->correlative = PurchaseOrder::max('correlative') + 1;
    }

    public function save()
    {
        //
    }

    public function render()
    {
        return view('livewire.admin.purchase-order.purchase-order-create');
    }
}
