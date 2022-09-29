<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attrs = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (auth()->attempt($attrs)) {
            // auth()->attempt() checks and logs in

            // session fixation
            session()->regenerate();

            return redirect('/')->with('success', 'Weclome back!');
        }

        // auth failed: 
        // The following 2 ways do the same things:
        // // Way 1:
        // return back()
        //     ->withInput()
        //     ->withErrors(['email' => 'The combination of email and password inputted could not be verified.']);
        // Way 2:
        throw ValidationException::withMessages(
            [
                'email' => 'The combination of email and password inputted could not be verified.'
            ]
        );
    }

    //
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Successfully logged out!');
    }
}
