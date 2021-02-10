<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $status
 * @property Product[] $products
 * @property SubCat[] $subCats
 */

class Cat extends Model
{
    const VISIBLE = 0;
    const HIDDEN = 1;

    public $timestamps = null;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cat';

    /**
     * @var array
     */
    protected $fillable = ['name', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany('App\Models\Product', 'c_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCat()
    {
        return $this->hasMany('App\Models\SubCat', 'c_id');
    }
    
}

