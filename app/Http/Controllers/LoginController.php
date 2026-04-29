<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class LoginController extends Controller
{
    public function showlogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscar usuario por nombre de usuario
        $user = Users::where('usuario', $data['usuario'])->first();

        // Verificar si el usuario existe y la contraseña coincide
        if ($user && $user->password === $data['password']) {
            // Iniciar sesión con el modelo Users (debe ser Authenticatable)
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/players');
        }

        return back()->withErrors(['message' => 'Credenciales incorrectas']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}