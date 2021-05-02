<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $value
 */
class Setting extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'settings';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    // protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'value'];

}
