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
    const VISIBLE = 0;
    const HIDDEN = 1;

    public $tmp = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'product';

    /**
     * @var array
     */
    protected $fillable = ['sc_id', 'c_id', 'name', 'model', 'price', 'desc', 'status', 'size'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCat()
    {
        return $this->belongsTo('App\Models\SubCat', 'sc_id');
    }

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
}
