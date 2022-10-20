<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use HasFactory;
    protected $guarded = [];

    public function posts(){
        return $this->hasManyThrough('Posts', 'Topics');
    }
    
    public function postss(){
        return $this->hasManyDeep(Posts::class, [Topics::class], ['category_id', 'topic_id']);
    }

    public function topics(){
        return $this->hasMany(Topics::class, 'category_id');
    }

}
