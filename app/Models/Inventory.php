<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'detail',
        'quantity_in',
        'cost_in',
        'total_in',
        'quantity_out',
        'cost_out',
        'total_out',
        'quantity_balance',
        'cost_balance',
        'total_balance',
        'inventoryable_id',
        'inventoryable_type',
    ];

    /**
     * Get the product that owns the Inventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the warehouse that owns the Inventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the parent model that this inventory belongs to.
     *
     * This is an inverse polymorphic one-to-one relationship. It allows an
     * inventory to belong to different types of models (e.g., a Product, a
     * Warehouse, etc.) using a single relationship. The specific parent
     * model is determined by the `inventoryable_type` and `inventoryable_id`
     * columns on this model's table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function inventoryable(): MorphTo
    {
        return $this->morphTo();
    }
}
