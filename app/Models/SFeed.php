<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class SFeed extends Model
{
    protected $fillable = array('key', 'status', 'slug');
    public $timestamps = false;
}
