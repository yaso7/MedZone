<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class vendor extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'contact_name',
        'location',
    ];

    public function product()
    {
        return $this->hasMany(product::class);
    }

    public function order()
    {
        return $this->hasMany(order::class);
    }
}
