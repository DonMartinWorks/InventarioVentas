<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Builder;

class PurchaseOrderDatatable extends DataTableComponent
{
    // protected $model = PurchaseOrder::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('id', 'desc');

        /**
         *  $this->setAdditionalSelects([
         *      'purchase_orders.id', // configure
         *  ]);
         *  Column::make(__("Id"), "id")
         *      ->sortable(), // comment this
         */
    }

    public function columns(): array
    {
        return [
            Column::make(__("Id"), "id")
                ->sortable(),
            Column::make(__("Supplier"), "supplier.name")
                ->sortable()
                ->searchable()
                ->deselected(),
            Column::make(__("Voucher Type"), "voucher_type")
                ->sortable()
                ->searchable()
                ->deselected(),
            Column::make(__("Series"), "series")
                ->searchable()
                ->sortable(),
            Column::make(__("Correlative"), "correlative")
                ->searchable()
                ->sortable(),
            Column::make(__("Date"), "date")
                ->sortable()
                ->searchable()
                ->format(fn($value) => $value->format('d-m-Y')),
            Column::make(__("Document"), "supplier.document_number")
                ->searchable()
                ->sortable(),
            Column::make(__("Company Name"), "supplier.name")
                ->searchable()
                ->sortable(),
            Column::make(__("Total"), "total")
                ->sortable()
                ->format(fn($value) => 'CLP$ ' . number_format($value, 2, ',', '.')),
            Column::make(__("Observations"), "observations")
                ->sortable()
                ->deselected(),
            Column::make(__('Created at'), "created_at")
                ->format(function ($value) {
                    return $value->format('d/m/Y (H:i:s)');
                })
                ->sortable()
                ->deselected(),
            Column::make(__("Actions"))
                ->label(function ($row) {
                    return view(
                        'admin.management.purchase_orders.actions',
                        ['purchaseOrder' => $row]
                    );
                })
        ];
    }

    public function builder(): Builder
    {
        return PurchaseOrder::query()
            ->with(['supplier']);
    }
}
