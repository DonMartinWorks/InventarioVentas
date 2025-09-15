<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Warehouse;

class WarehouseDatatable extends DataTableComponent
{
    protected $model = Warehouse::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('name', 'DESC');
    }

    public function columns(): array
    {
        return [
            Column::make(__("Id"), "id")
                ->sortable(),
            Column::make(__("Name"), "name")
                ->searchable()
                ->sortable(),
            Column::make(__("Location"), "location")
                ->searchable()
                ->sortable(),
            Column::make(__('Created at'), "created_at")
                ->format(function ($value) {
                    return $value->format('d/m/Y (H:i:s)');
                })
                ->sortable()
                ->deselected(),
            Column::make(__('Updated at'), "updated_at")
                ->format(function ($value) {
                    return $value->format('d/m/Y (H:i:s)');
                })
                ->sortable()
                ->deselected(),
            Column::make(__("Actions"))
                ->label(function ($row) {
                    return view(
                        'admin.management.warehouses.actions',
                        ['warehouse' => $row]
                    );
                })
        ];
    }
}
