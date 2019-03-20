<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class SUser extends Model
{
    protected $fillable = array('key', 'status', 'follower');
    public $timestamps = false;
}
