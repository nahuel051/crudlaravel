<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function getintoDate(Request $request)
    {   // Validación de datos de entrada para crear un nuevo jugador
        $data = $request->validate([
            'nombre' => 'required|string',
            'edad' => 'required|integer',
            // 'team_id' es opcional (nullable) debe existir en la tabla 'teams' (exists:teams,id)
            'team_id' => 'nullable|integer|exists:teams,id',
        ]);
        // Creación de un nuevo jugador utilizando los datos validados
        //new Player() crea una nueva instancia del modelo Player, que representa un nuevo jugador en la base de datos.
        $player = new Player();
        $player->nombre = $request->input('nombre');
        $player->edad = $request->input('edad');
        // El operador null asigna el valor de $data['team_id'] si existe, o null si no se proporciona.
        $player->team_id = $data['team_id'] ?? null;
        $player->save();

        return redirect('/players');
    }

    public function showPlayers()
    {
        $players = Player::all();
        $teams = Team::all();
    // Retorna la vista 'futbol' con los datos de jugadores y equipos para mostrar en la interfaz
        return view('futbol', [
            'players' => $players,
            'teams' => $teams,
        ]);
    }
    //deletePlayer($id) busca el jugador por su ID utilizando Player::find($id). Si el jugador existe, se elimina de la base de datos con $player->delete(). Luego, redirige al usuario a la lista de jugadores con redirect('/players').
    public function deletePlayer($id)
    {
        $player = Player::find($id);
        if ($player) {
            $player->delete();
        }
        return redirect('/players');
    }
    //editPlayer($id) busca el jugador por su ID y obtiene la lista de equipos. Si el jugador existe, retorna la vista 'edit' con los datos del jugador y los equipos para mostrar en un formulario de edición. Si el jugador no existe, redirige a la lista de jugadores.
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
    //updatePlayer(Request $request, $id) valida los datos de entrada para actualizar un jugador existente. Busca el jugador por su ID y, si existe, actualiza sus atributos con los nuevos valores proporcionados en la solicitud. Luego, guarda los cambios en la base de datos y redirige a la lista de jugadores.
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
    //searchplayers(Request $request) obtiene el término de búsqueda de la solicitud y realiza una consulta para encontrar jugadores cuyo nombre, edad o nombre del equipo coincidan con el término de búsqueda. Utiliza el método whereHas para buscar coincidencias en la relación con el modelo Team. Luego, retorna la vista 'futbol' con los resultados de la búsqueda y la lista de equipos.
    public function searchplayers(Request $request)
    {
        $searchTerm = $request->input('search');
        $teamId = $request->team_id;
        $players = Player::where('nombre', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('edad', 'LIKE', '%' . $searchTerm . '%')
            // orWhereHas: sirve para aplicar or sobre realaciones, busca en tabla relacionada (teams) a través de la relación 'team'
            // 1. 'team' → método definido en Player.php que retorna belongsTo(Team::class)
            // 2. function ($query) → closure que define condiciones sobre la tabla relacionada
            // 3. where('name', 'LIKE', '%' . $searchTerm . '%') → filtra por nombre del equipo
            ->orWhereHas('team', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->get();
            if ($teamId) {
                $players = $players->where('team_id', $teamId);
            }
        $teams = Team::all();

        return view('futbol', [
            'players' => $players,
            'teams' => $teams,
            'team_id' => $teamId,
        ]);
    }
}
