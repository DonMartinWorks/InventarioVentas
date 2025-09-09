<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;

class CustomerDatatable extends DataTableComponent
{
    protected $model = Customer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__("Id"), "id")
                ->sortable(),
            Column::make(__("Document Type"), "identity.name")
                ->sortable()
                ->searchable(),
            Column::make(__("Document Number"), "document_number")
                ->sortable()
                ->searchable(),
            Column::make(__("Company Name"), "name")
                ->sortable()
                ->searchable(),
            Column::make(__("Email"), "email")
                ->sortable()
                ->searchable(),
            Column::make(__("Address"), "address")
                ->sortable()
                ->deselected(),
            Column::make(__("Phone"), "phone")
                ->sortable()
                ->searchable(),
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
                        'admin.management.customers.actions',
                        ['customer' => $row]
                    );
                })
        ];
    }

    public function builder(): Builder
    {
        return Customer::query()
            ->with(['identity']);
    }
}
