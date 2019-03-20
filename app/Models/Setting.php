<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Setting extends Model
{
    protected $fillable = array('title', 'slug', 'type', 'content', 'client_id');

    protected $casts = [
        'content' => 'array'
    ];

    public $timestamps = false;
}