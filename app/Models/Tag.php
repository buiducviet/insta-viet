<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Tag extends Model
{
    protected $fillable = array('name', 'slug', 'seo', 'status', 'parent_id', 'keyword', 'icon');
    public $timestamps = false;

    protected $casts = [
        'seo' => 'array'
    ];

    public function parent() {
        return $this->hasOne('\App\Models\Tag', 'id', 'parent_id');
    }

    function childs() {
        return $this->hasMany('\App\Models\Tag', 'parent_id');
    }

    function articles() {
        return $this->belongsToMany('\App\Models\Article', 'article_tags', 'tag_id', 'article_id');
    }

    function groups() {
        return $this->belongsToMany('\App\Models\Group', 'group_tags', 'tag_id', 'group_id');
    }
}
