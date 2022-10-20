<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post_list()
    {
        return $this->hasMany(Posts::class, 'user_id');
    }

    public function check()
    {
        return $this->hasManyDeep(CheckPosts::class, [Posts::class], ['user_id', 'post_id']);
    }

    public function check2()
    {
        return $this->hasManyThrough(CheckPosts::class, Posts::class, 'user_id', 'post_id');
    }
}
