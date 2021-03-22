<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        
     return view ('auth.register');
    }

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function store(Request $requst)
    {
        $this->validate($requst, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
        ]); 



        User::create([
            'name' => $requst->name,
            'username' => $requst->username,
            'email' => $requst->email,
            'password' => Hash::make($requst->password),
        ]);

        auth()->attempt($requst->only('email', 'password'));

        return  redirect()->route('dashboard');
    }
}
