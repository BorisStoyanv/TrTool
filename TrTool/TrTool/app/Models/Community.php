<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_user');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
   

}
