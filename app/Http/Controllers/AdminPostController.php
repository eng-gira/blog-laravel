<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50),
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        // Validations
        $validatedAttributes = $this->validatePost();

        // add the user_id
        $validatedAttributes['user_id'] = auth()->id();
        $validatedAttributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($validatedAttributes);

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        // Validations
        $validatedAttributes = $this->validatePost($post);

        if ($validatedAttributes['thumbnail'] ?? false) {
            $validatedAttributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($validatedAttributes);

        return back()->with('success', 'Post Updated Successfully.');
    }

    public function delete(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post Deleted Successfully.');
    }

    protected function validatePost(?Post $post = null)
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'body' => 'required',
            'excerpt' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
    }
}
