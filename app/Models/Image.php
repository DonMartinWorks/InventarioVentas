<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
        'size',
        'imageable_id',
        'imageable_type',
    ];

    /**
     * Get the parent model that this image belongs to.
     *
     * This is an inverse polymorphic relationship that allows an image to be
     * associated with different types of models (e.g., a User, a Product,
     * a Post, etc.). The specific parent model is determined by the
     * `imageable_type` and `imageable_id` columns on this model's table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
