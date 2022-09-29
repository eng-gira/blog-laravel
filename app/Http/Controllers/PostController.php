<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    //
    public function index()
    {
        // dd(Gate::allows('admin'));
        // dd(request()->user()->cannot('admin'));
        // dd($this->authorize('admin'));

        $posts = Post::latest()
            ->with('category', 'author')
            ->filter(request(["search", "category", "author"]))
            ->paginate(6)
            ->withQueryString();

        return view('posts.index', [
            "posts" => $posts,
        ]);
    }

    public function show(Post $post)
    {
        return view("posts.show", [
            "post" => $post,
        ]);
    }
}
