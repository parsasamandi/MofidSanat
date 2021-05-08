<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $status
 * @property Product[] $products
 * @property Subcategories[] $subcategories
 */

class Category extends Model
{
    const VISIBLE = 0;
    const HIDDEN = 1;

    public $timestamps = null;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategory()
    {
        return $this->hasMany('App\Models\Subcategory', 'category_id');
    }

    /*
     * Get all of the categories status.
     */
    public function statuses() {
        return $this->morphOne('App\Models\Status', 'status');
    }
    
}

