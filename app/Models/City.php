<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function province()
    {
        return $this->belongsTo(Provincy::class, "province_id", "province_id");
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, "product_variant_id", "id");
    }
}
