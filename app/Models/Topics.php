<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use HasFactory;
    protected $guarded = [];

    // Mối quan hệ một nhiều giữa topic và categories
    public function categories(){
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function postss(){
        return $this->hasMany(Posts::class, 'topic_id');
    }

    public function post_view(){
        return $this->hasManyDeep(PostViews::class, [Posts::class], ['topic_id', 'post_id']);
    }
}
