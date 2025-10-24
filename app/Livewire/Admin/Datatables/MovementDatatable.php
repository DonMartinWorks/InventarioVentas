<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Movement;
use Illuminate\Database\Eloquent\Builder;

class MovementDatatable extends DataTableComponent
{
    protected $model = Movement::class;

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
            Column::make(__("Reason"), "reason.name")
                ->sortable()
                ->searchable(),
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
            Column::make(__("Type"), "type")
                ->sortable()
                ->format(
                    fn($value) => match ($value) {
                        1 => __('Income'),
                        2 => __('Outcome'),
                        default => __('Unknown')
                    }
                )
                ->searchable(),
            Column::make(__("Warehouse"), "warehouse.name")
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
                        'admin.management.movements.actions',
                        ['movement' => $row]
                    );
                })
        ];
    }

    public function builder(): Builder
    {
        return Movement::query()
            ->with(['warehouse', 'reason']);
    }
}
