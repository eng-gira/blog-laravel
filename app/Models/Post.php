<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = ['title', 'excerpt', 'body'];

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters["search"])) {
            $query->where(
                fn ($query) =>
                $query->where('title', 'like', '%' . $filters["search"] . '%')
                    ->orWhere('body', 'like', '%' . $filters["search"] . '%')
            );
        }
        if (isset($filters["category"])) {
            // // Way 1
            // $query
            //     ->whereExists(
            //         function ($query) use ($filters) {
            //             $query->from('categories')
            //                 ->whereColumn('categories.id', 'posts.category_id')
            //                 ->where('categories.slug', $filters['category']);
            //         }
            //     );

            // Way 2
            $query
                // 'category' corresponds to a relationship
                ->whereHas('category', function ($query) use ($filters) {
                    $query->where('slug', $filters['category']);
                });
        }

        if (isset($filters["author"])) {
            $query
                ->whereHas('author', function ($query) use ($filters) {
                    $query->where('username', $filters['author']);
                });
        }
    }

    public function category()
    {
        // hasOne, hasMany, belongsTo, belongsToMany, 
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
