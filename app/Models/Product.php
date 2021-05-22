<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sc_id
 * @property int $c_id
 * @property string $name
 * @property string $model
 * @property float $price
 * @property string $desc
 * @property int $status
 * @property int $size
 * @property SubCat $subCat
 * @property Cat $cat
 * @property Medium[] $media
 * @property PhoneNumber[] $phoneNumbers
 */
class Product extends Model
{
    // Visibility
    const VISIBLE = 0;
    const HIDDEN = 1;
    
    // Media
    const IMAGE = 0;
    const VIDEO = 1;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['subcategory_id', 'category_id', 'name', 'model', 'price', 'desc', 'status', 'size'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory', 'subcategory_id');
    }

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
    public function media()
    {
        return $this->hasMany('App\Models\Media');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phoneNumbers()
    {
        return $this->hasMany('App\Models\PhoneNumber');
    }

    /*
     * Get all of the course's status.
     */
    public function statuses() {
        return $this->morphOne('App\Models\Status', 'status');
    }

    
}
