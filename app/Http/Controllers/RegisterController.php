<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;

use function Pest\Laravel\get;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    function index() {
    return view('auth.register');
    }

    function store(Request $request) {
        // dd($request);
        // dd($request->get('email'));
        
        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);
        
        //Validacion
        $this->validate($request,[
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);
        
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        //Autenticar usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);
        //Otra forma para autenticar
        auth()->attempt($request->only('email','password'));
        // Envía el correo electrónico al usuario que ha iniciado sesión
        Mail::to($request->email)->send(new RegistrationMail($request->user()));
        
        //Redireccionar
        return redirect()->route('home');
    }

    // function redirect(){    
    //     return Socialite::driver('facebook')->redirect();
    // }
    // function callback(){
    //     $user = Socialite::driver('facebook')->user();
    //     dd($user);
    // }
}
