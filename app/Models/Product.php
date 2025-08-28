<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'sku',
        'bar_code',
        'price',
        'category_id',
    ];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the inventories for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Get all the purchase orders that the product is a part of.
     *
     * This is a polymorphic many-to-many relationship. It allows a Product to be
     * part of many different purchase orders, and each purchase order can have
     * many products. The `productable` morph name is used to indicate that
     * this model is related through the polymorphic `productables` table.
     *
     */
    public function purchaseOrders(): MorphToMany
    {
        return $this->morphedByMany(PurchaseOrder::class, 'productable');
    }

    /**
     * Get all the quotes that the product is a part of.
     *
     * This is a polymorphic many-to-many relationship. It allows a Product to be
     * part of many different quotes, and each quote can have many products. The
     * `productable` morph name is used to indicate that this model is related
     * through the polymorphic `productables` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function quotes(): MorphToMany
    {
        return $this->morphedByMany(Quote::class, 'productable');
    }

    /**
     * Get all the sales that the product is a part of.
     *
     * This is a polymorphic many-to-many relationship. It allows a Product to be
     * part of many different sales, and each sale can have many products. The
     * `productable` morph name is used to indicate that this model is related
     * through the polymorphic `productables` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function sales(): MorphToMany
    {
        return $this->morphedByMany(Sale::class, 'productable');
    }

    /**
     * Get all the transfers that the product is a part of.
     *
     * This is a polymorphic many-to-many relationship. It allows a Product to be
     * part of many different transfers, and each transfer can have many products. The
     * `productable` morph name is used to indicate that this model is related
     * through the polymorphic `productables` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function transfers(): MorphToMany
    {
        return $this->morphedByMany(Transfer::class, 'productable');
    }

    /**
     * Get all of the images for this model.
     *
     * This is a polymorphic one-to-many relationship. It allows the model to have
     * many images, and the specific parent model (this model) is identified
     * by the `imageable_type` and `imageable_id` columns on the `images` table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
