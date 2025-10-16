<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Builder;

class QuoteDatatable extends DataTableComponent
{
    // protected $model = Quote::class;

    public function configure(): void
    {
         $this->setPrimaryKey('id');

        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make(__("Id"), "id")
                ->sortable(),
            Column::make(__("Customer"), "customer.name")
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
            Column::make(__("Document"), "customer.document_number")
                ->searchable()
                ->sortable(),
            Column::make(__("Company Name"), "customer.name")
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
                        'admin.management.quotes.actions',
                        ['purchaseOrder' => $row]
                    );
                })
        ];
    }

    public function builder(): Builder
    {
        return Quote::query()
            ->with(['customer']);
    }
}
