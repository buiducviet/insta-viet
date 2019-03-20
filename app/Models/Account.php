<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Account extends Model
{
    protected $fillable = array(
    	'username', 'password', 'status', 'order', 'data', 'client_id'
    );

    protected $casts = [
        'data' => 'array'
    ];

    public function client() {
        return $this->hasOne('\App\Models\Client', 'id', 'client_id');
    }
}
