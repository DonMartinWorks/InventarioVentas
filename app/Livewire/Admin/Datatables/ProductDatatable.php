<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class ProductDatatable extends DataTableComponent
{
    // protected $model = Product::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setColumnSelectStatus(true);
    }

    public function columns(): array
    {
        return [
            Column::make(__("Id"), "id")
                ->sortable(),
            ImageColumn::make(__('Image'))
                ->location(
                    fn($row) => $row->image
                )
                ->html()
                ->attributes(fn($row) => [
                    'class' => 'w-24 h-24 object-cover object-center aspect-square',
                    'style' => 'width: 125px; max-height: 125px;',
                ]),
            Column::make(__("Name"), "name")
                ->searchable()
                ->sortable(),
            Column::make(__("Description"), "description")
                ->sortable()
                ->deselected(),
            Column::make(__("Category"), "category.name")
                ->sortable()
                ->searchable(),
            Column::make(__("Price"), "price")
                ->sortable()
                ->searchable(),
            Column::make(__("SKU"), "sku")
                ->sortable()
                ->searchable()
                ->deselected(),
            Column::make(__("Bar code"), "bar_code")
                ->sortable()
                ->searchable()
                ->deselected(),
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
                        'admin.management.products.actions',
                        ['product' => $row]
                    );
                })
        ];
    }

    public function builder(): Builder
    {
        return Product::query()
            ->with(['category', 'images']);
    }
}
