<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contract extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'status',
        'offers_and_notes',
        'expires_at',
    ];

    public function product()
    {
        return $this->hasMany(product::class);
    }
}
