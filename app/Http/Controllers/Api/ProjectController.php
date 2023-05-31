<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        // prendo tutti i progetti
        // $projects = Project::all();

        // leggo anche le tabelle collegate ai progetti
        // $projects = Project::with('type', 'technologies')->orderBy('projects.created_at', 'desc')->get();

        $projects = Project::with('type', 'technologies')->orderBy('projects.created_at', 'desc')->paginate(8);

        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($slug){
        // prelevo i dati dal modello cercando solo lo slug che mi interessa
        $project = Project::where('slug', $slug)->first();

        // se ottengo effettivamente un post dal front end con quello slug allora lo mando
        if($project){
            return response()->json([
                'success' => true,
                'result' => $project,
            ]);
        } else{
            // altrimenti mando un messaggio di errore che gestirò dal front end
            return response()->json([
                'success' => false,
                'error' => 'Il progetto selezionato non esiste',
            ]);
        }
    }

}
