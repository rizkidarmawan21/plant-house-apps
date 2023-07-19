<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionShipping extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $with = ['province', 'city'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function province()
    {
        return $this->belongsTo(Provincy::class, 'provincy_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
