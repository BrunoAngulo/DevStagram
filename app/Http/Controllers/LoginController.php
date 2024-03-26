<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (!auth()->attempt($request->only('email','password'), $request->remember)) {
            return back()->with('mensaje','Credenciales Incorrectas');
        }

        // Envía el correo electrónico al usuario que ha iniciado sesión
        Mail::to(auth()->user()->email)->send(new Email(auth()->user()));

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
