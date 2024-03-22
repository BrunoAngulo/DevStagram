<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user, Request $request) {
        // Agregar el seguidor actual al usuario especificado
        $user->followers()->attach(auth()->user()->id);
        
        // Redirigir de vuelta a la página anterior
        return back();  
    }

    public function destroy(User $user, Request $request) {
        // Agregar el seguidor actual al usuario especificado
        $user->followers()->detach(auth()->user()->id);
        return back();  
    }
    
}
