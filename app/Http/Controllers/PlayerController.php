<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function getintoDate(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'edad' => 'required|integer',
        ]);
        $player = new Player();
        $player->nombre = $request->input('nombre');
        $player->edad = $request->input('edad');
        $player->save();

        return redirect('/players');
    }

    public function showPlayers()
    {
        $players = Player::all();
        // Aquí retornamos la vista 'futbol' y le pasamos los datos de los jugadores
        // para que estén disponibles en la vista como la variable $players.
        return view('futbol', ['players' => $players]);
    }

    public function deletePlayer($id)
    {
        $player = Player::find($id);
        if ($player) {
            $player->delete();
        }
        return redirect('/players');
    }
    public function editPlayer($id)
    {
        $player = Player::find($id);
        if ($player) {
            return view('edit', ['player' => $player]);
        }
        return redirect('/players');
    }
    public function updatePlayer(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'edad' => 'required|integer',
        ]);

        $player = Player::find($id);
        if ($player) {
            $player->nombre = $request->input('nombre');
            $player->edad = $request->input('edad');
            $player->save();
        }
        return redirect('/players');
    }
    public function searchplayers(Request $request)
    {
        $searchTerm = $request->input('search');
        $players = Player::where('nombre', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('edad', 'LIKE', '%' . $searchTerm . '%')
        ->get();        return view('futbol', ['players' => $players]);
    }
}
