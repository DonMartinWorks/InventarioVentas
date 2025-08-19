<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PurchaseOrder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supplier_id',
        'voucher_type',
        'series',
        'correlative',
        'date',
        'total',
        'observation'
    ];

    /**
     * Get the supplier that owns the PurchaseOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get all the products for the sale.
     *
     * This is a many-to-many polymorphic relationship. It allows a Sale to have
     * many Products, and each Product can be part of many different sales.
     * The intermediate table `productables` stores additional information
     * about the relationship, such as the `quantity`, `price`, `subtotal`,
     * and the timestamps (`created_at`, `updated_at`) for each product
     * in this specific sale.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function products(): MorphToMany
    {
        return $this->morphToMany(Product::class, 'productable')
            ->withPivot('quantity', 'price', 'subtotal')
            ->withTimestamps();
    }
}
