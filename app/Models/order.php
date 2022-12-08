<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    use HasFactory;

     use SoftDeletes;

    protected $fillable = [
        'status',
        'full_price',
        'customer_id',
        'vendor_id',
        'type',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function vendor()
    {
        return $this->belongsTo(vendor::class);
    }


    public function product()
    {
      return $this->belongsToMany(product::Class, 'order_has_products');
    }

}
