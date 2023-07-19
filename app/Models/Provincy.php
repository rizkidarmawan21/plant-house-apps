<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincy extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'province',
    ];

    public function cities()
    {
        return $this->hasMany(City::class, "province_id", "province_id");
    }
}
