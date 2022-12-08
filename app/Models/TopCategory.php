<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopCategory extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
        'slug',
        'type',
    ];

    public function product()
    {
        return $this->hasMany(product::class);
    }

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }
}
