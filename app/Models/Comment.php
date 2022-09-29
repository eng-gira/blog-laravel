<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); // pass user_id: the col is not author_id but user_id (method name matters).
    }
    public function post() // post_id
    {
        return $this->belongsTo(Post::class);
    }
}
