<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $responsibility
 * @property string $linkedin_address
 * @property int $size
 * @property string $image
 */
class Team extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'responsibility', 'linkedin_address', 'size', 'image'];

}
