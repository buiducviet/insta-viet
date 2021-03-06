<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class SLocation extends Model
{
    protected $fillable = array('key', 'status');
    public $timestamps = false;
}
