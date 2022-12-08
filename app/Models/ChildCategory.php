<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildCategory extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
        'slug',
        'sub_category_id',
    ];

    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
