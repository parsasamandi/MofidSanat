<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

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
    /**
     * Cascade On Delete.
     */
    use CascadesDeletes;
    protected $cascadeDeletes = ['media'];

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'responsibility', 'linkedin_address', 'size'];


    /*
     * Get all of the team member's image.
     */
    public function media()
    {
        return $this->morphOne('App\Models\Media', 'media');
    }

}
