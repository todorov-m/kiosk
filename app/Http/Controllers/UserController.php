<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }

    public function store()
    {
        $request = request()-> validate([
            'name' => 'required',
            'username' =>'required',
            'password' => ['required','min:4'],
            'level' => 'required'
        ]);


        User::create($request);

        return back()->with('success', 'Потребителя е добавен');
    }

    public function login()
    {
        $request = request()-> validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);

        if(auth()->attempt($request))
        {
            return redirect('/');
        }

        return back()->withErrors([
            'username' => 'Грешен или несъществуващ Потребител!'
        ]);
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!!!');
    }
}
