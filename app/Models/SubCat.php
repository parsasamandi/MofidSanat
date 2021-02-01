<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $c_id
 * @property string $name
 * @property int $status
 * @property Cat $cat
 * @property Product[] $products
 */
class SubCat extends Model
{
    public $tmp = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sub_cat';

    /**
     * @var array
     */
    protected $fillable = ['c_id', 'name', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cat()
    {
        return $this->belongsTo('App\Models\Cat', 'c_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'sc_id');
    }
}
