<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Client extends Model
{
    protected $fillable = array('host', 'setting');
    public $timestamps = false;

    protected $casts = [
        'setting' => 'array'
    ];

    function groups() {
        return $this->belongsToMany('\App\Models\Group', 'client_groups', 'client_id', 'group_id');
    }

    function menus() {
        return $this->belongsToMany('\App\Models\Tag', 'client_menus', 'client_id', 'tag_id');
    }

    function blocks() {
        return $this->belongsToMany('\App\Models\Tag', 'client_blocks', 'client_id', 'tag_id');
    }

    public function settings() {
        return $this->hasMany('\App\Models\Setting', 'client_id');
    }
}
