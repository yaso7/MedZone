<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'code',
        'status',
        'price',
        'top_category_id',
        'vendor_id',
        'contract_id',
        'type',
        'arabic_desc',
        'english_desc',
        'country_of_origin',
        'product_line',
        'brand_name',
        'pdf',
        'url',
        'quantity',
        'manufacturer',
        'manufacturer_logo',
    ];

    public function TopCategory()
    {
        return $this->belongsTo(TopCategory::class);
    }

    public function vendor()
    {
        return $this->belongsTo(vendor::class);
    }

    public function contract()
    {
        return $this->belongsTo(contract::class);
    }

    public function order() 
    {
      return $this->belongsToMany(order::Class, 'order_has_products');
    }

}
