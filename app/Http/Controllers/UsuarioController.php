<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Users;
use App\Models\Roles;

class UsuarioController extends Controller
{

    public function createUsers(Request $request)
    {
        $data = $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
            'id_rol' => 'required|integer|exists:rol,id',
        ]);
        $usuario = new Users();
        $usuario->usuario = $data['usuario'];
        $usuario->password = $data['password'];
        $usuario->id_rol = $data['id_rol'];
        $usuario->save();
        return redirect('/usuarios');    }
    public function showUsers()
    {
        $usuarios = Users::all();
        $roles = Roles::all();
        return view('usuarios', [
            'usuarios' => $usuarios,
            'roles' => $roles,
        ]);
    }
}
