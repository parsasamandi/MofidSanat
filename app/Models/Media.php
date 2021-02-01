<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $media_id
 * @property int $product_id
 * @property string $media_url
 * @property int $type
 * @property Product $product
 */
class Media extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'media';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'media_url', 'type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
