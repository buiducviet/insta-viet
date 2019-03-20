<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Top extends Model
{
    protected $fillable = array('username', 'name', 'follower', 'following', 'media', 'key', 'avatar', 'city', 'sort');
    public $timestamps = false;
}
