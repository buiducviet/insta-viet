<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Article extends Model
{
    protected $fillable = array(
    	'title', 'seo', 'status', 'viewed', 'thumb', 'cover', 'slug', 'content', 'type'
    );

    protected $casts = [
        'seo' => 'array'
    ];

    function groups() {
        return $this->belongsToMany('\App\Models\Group', 'article_groups', 'article_id', 'group_id');
    }

    function tags() {
        return $this->belongsToMany('\App\Models\Tag', 'article_tags', 'article_id', 'tag_id');
    }
}
