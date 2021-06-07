<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $font_awesome
 */
class Service extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'font_awesome'];

}
