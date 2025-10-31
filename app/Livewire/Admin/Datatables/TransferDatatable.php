<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Transfer;
use Illuminate\Database\Eloquent\Builder;

class TransferDatatable extends DataTableComponent
{
    protected $model = Transfer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__("Id"), "id")
                ->sortable(),
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
            Column::make(__("Origin Warehouse"), "originWarehouse.name")
                ->searchable()
                ->sortable(),
            Column::make(__("Destination Warehouse"), "destinationWarehouse.name")
                ->searchable()
                ->sortable(),
            Column::make(__("Total"), "total")
                ->sortable()
                ->format(fn($value) => 'CLP$ ' . number_format($value, 2, ',', '.')),
            Column::make(__("Observations"), "observation")
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
                        'admin.management.transfers.actions',
                        ['transfer' => $row]
                    );
                })
        ];
    }

    public function builder(): Builder
    {
        return Transfer::query()
            ->with(['originWarehouse', 'destinationWarehouse']);
    }
}
