<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $c_id
 * @property string $name
 * @property int $status
 * @property Category $category
 */
class Subcategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['category_id', 'name', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'subcategory_id');
    }
}
