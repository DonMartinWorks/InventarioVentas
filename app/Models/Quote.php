<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Quote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'voucher_type',
        'series',
        'correlative',
        'date',
        'customer_id',
        'total',
        'observations',
    ];

    /**
     * Get the customer that owns the Quote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get all the products for the quote.
     *
     * This is a many-to-many polymorphic relationship. It allows a Quote to have
     * many Products, and each Product can be part of many different quotes.
     * The intermediate table `productables` stores additional information
     * about the relationship, such as the `quantity`, `price`, `subtotal`,
     * and the timestamps (`created_at`, `updated_at`) for each product
     * in this specific quote.
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
