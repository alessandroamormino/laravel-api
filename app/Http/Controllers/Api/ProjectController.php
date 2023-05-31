<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request){

    // $projects = Project::with('type', 'technologies')->orderBy('projects.created_at', 'desc')->paginate(8);

      $requestData = $request->all();

      $types = Type::all();

      // controllo se è stata selezionata una tipologia di progetto
      if($request->has('type_id') && $requestData['type_id']){
      $projects = Project::where('type_id', $requestData['type_id'])
        ->with('type', 'technologies')
        ->orderBy('projects.created_at', 'desc')
        ->paginate(8);

        // controllo se la chiamata non da nessun risultato
        if(count($projects) == 0){
          return response()->json([
            'success' => false,
            'error' => 'No project made with this type.',
          ]);
        }
        
      } else{
        $projects = Project::with('type', 'technologies')->orderBy('projects.created_at', 'desc')->paginate(8); 
      }

      return response()->json([
          'success' => true,
          'results' => $projects,
          'allTypes' => $types,
      ]);
    }

    public function show($slug){
        // prelevo i dati dal modello cercando solo lo slug che mi interessa
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        // se ottengo effettivamente un post dal front end con quello slug allora lo mando
        if($project){
            return response()->json([
                'success' => true,
                'project' => $project,
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
