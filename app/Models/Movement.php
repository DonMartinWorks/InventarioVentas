<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Movement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'warehouse_id',
        'reason_id',
        'type',
        'series',
        'correlative',
        'date',
        'total',
        'observation',
    ];

    /**
     * Get all the products for the movement.
     *
     * This is a many-to-many polymorphic relationship. It allows a Movement to have
     * many Products, and each Product can be part of many different movements.
     * The intermediate table `productables` stores additional information
     * about the relationship, such as the `quantity`, `price`, `subtotal`,
     * and the timestamps (`created_at`, `updated_at`) for each product
     * in this specific movement.
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
