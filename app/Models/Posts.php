<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Mối quan hệ một nhiều giữa post và topic
    public function topics(){
        return $this->belongsTo(Topics::class, 'topic_id');
    }
    
    public function postviews(){
        return $this
            ->belongsToMany(PostViews::class, 'post_views', 'post_id')
            ->withTimestamps();
    }

    public function post_view(){
        return $this->hasMany(PostViews::class, 'post_id');
    }

    public function post_user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post_check(){
        return $this->hasOne(CheckPosts::class, 'post_id');
    }

    public function comment(){
        return $this->hasMany(Comments::class, 'post_id');
    }
}
