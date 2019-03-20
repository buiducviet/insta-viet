<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Feedback extends Model
{
	protected $table = 'feedbacks';
    protected $fillable = array('name', 'email', 'message', 'status');
}
