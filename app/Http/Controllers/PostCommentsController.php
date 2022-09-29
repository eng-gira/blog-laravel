<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    //
    public function store(\App\Models\Post $post)
    {
        // validations
        request()->validate([
            'body' => 'required'
        ]);

        // note that the following will automatically set the post id
        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => request('body')
        ]);

        return back();
    }
}
