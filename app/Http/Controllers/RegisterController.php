<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
   // Otros métodos...

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
        // Si deseas manejar la verificación de correo electrónico, debes agregar el campo 'email_verified_at' aquí.
        // $user->email_verified_at = now();
        $user->save();

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
