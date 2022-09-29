<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attrs = request()->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'max:255', 'min:3', Rule::unique("users", "username")], // if without array, '...|unique:users,username'
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|max:255|min:8',
        ]);
        // return request()->all();

        $user = User::create($attrs);

        auth()->login($user); // log the user in


        // session()->flash("success", "Your account has been created."); // same can be done with the redirect using with()

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
