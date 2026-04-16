<?php

namespace App\Http\Controllers;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function showTeams()
    {
        $teams = Team::all();
        return view('team', ['teams' => $teams]);
    }
    public function createTeam(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        // Team::create($data);
        $team = new Team();
        $team->name = $request->input('name');
        $team->save();
        
        return redirect('/teams');
    }
}
