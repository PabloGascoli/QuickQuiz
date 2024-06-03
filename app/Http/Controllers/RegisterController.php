<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  // Asegúrate de usar el espacio de nombres correcto para el modelo User
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Maneja una solicitud de registro para la aplicación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        event(new Registered($user));

        // Cierra la sesión del usuario después del registro para que tenga que iniciar sesión nuevamente
        Auth::logout();

        return redirect('/login')->with('status', 'Registration successful. Please log in.');
    }
}
