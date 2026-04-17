<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function getintoDate(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'edad' => 'required|integer',
            'team_id' => 'nullable|integer|exists:teams,id',
        ]);

        $player = new Player();
        $player->nombre = $request->input('nombre');
        $player->edad = $request->input('edad');
        $player->team_id = $data['team_id'] ?? null;
        $player->save();

        return redirect('/players');
    }

    public function showPlayers()
    {
        $players = Player::all();
        $teams = Team::all();

        return view('futbol', [
            'players' => $players,
            'teams' => $teams,
        ]);
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
        $teams = Team::all();

        if ($player) {
            return view('edit', [
                'player' => $player,
                'teams' => $teams,
            ]);
        }
        return redirect('/players');
    }

    public function updatePlayer(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'edad' => 'required|integer',
            'team_id' => 'nullable|integer|exists:teams,id',
        ]);

        $player = Player::find($id);
        if ($player) {
            $player->nombre = $request->input('nombre');
            $player->edad = $request->input('edad');
            $player->team_id = $request->input('team_id');
            $player->save();
        }
        return redirect('/players');
    }
    public function searchplayers(Request $request)
    {
        $searchTerm = $request->input('search');
        $players = Player::where('nombre', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('edad', 'LIKE', '%' . $searchTerm . '%')
            ->orWhereHas('team', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->get();
        $teams = Team::all();

        return view('futbol', [
            'players' => $players,
            'teams' => $teams,
        ]);
    }
}
