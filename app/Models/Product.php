<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $guarded = ['id'];

    protected $with = ["galleries", 'category', 'variants'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name',]
            ]
        ];
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, "product_id", "id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, "product_id", "id");
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, "product_id", "id");
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, "product_id", "id");
    }
}
