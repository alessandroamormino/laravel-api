<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //per fare la scelta della tipologia in fase di creazione devo passare alla rotta
        // tutte le possibili tipologie che ho nella tabella Type
        $types = Type::all();
        // passo anche l'elenco di tutte le tecnologie utilizzate
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // leggo tutti i dati del form presenti nella request e mi creo un oggetto
        $formData = $request->all();

        // richiamo la funzione per validare i dati prima di inviarli al db
        $this->validation($request);
        
        // creo un nuovo record del modello Project
        $newProject = new Project();

        // Controllo che sia presente un'immagine
        if($request->hasFile('thumb')){
            // creo la cartella delle immagini dentro lo storage
            $path = Storage::put('project_images', $request->thumb);

            // setto il campo thumb con solo la path dell'immagine
            $formData['thumb'] = $path;
        }

        // popolo TUTTI i campi presenti in Project il nuovo record 
        // con i dati presenti nell'oggetto formData
        $newProject->title = $formData['title'];
        $newProject->content = $formData['content'];
        // lo slug non viene richiesto in input ma viene calcolato sulla base del titolo che passa dal form
        $newProject->slug = Str::slug($formData['title'], '-');
        $newProject->thumb = $formData['thumb'];
        // $newProject->languages = $formData['languages'];
        // gli passo anche il type_id che proviene dalla select dentro al form 
        $newProject->type_id = $formData['type_id'];
        $newProject->repo = $formData['repo'];
        $newProject->website = $formData['website'];

        // salvo il record
        $newProject->save();

        // controllo se mi sta arrivando dal form l'array con le tecnologie utilizzate
        if(array_key_exists('technologies', $formData)){
            // popolo la tabella ponte con l'associazione progetto-tecnologia passato dal form
            $newProject->technologies()->attach($formData['technologies']);
        }

        // faccio un redirect alla pagina di show del nuovo record creato, passandogli il record come parametro
        return redirect()->route('admin.projects.show', $newProject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // per mostrare il singolo progetto passo come parametro il $project
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //per fare la scelta della tipologia in fase di modifica del singolo progetto, devo passare alla rotta
        // tutte le possibili tipologie che ho nella tabella Type
        $types = Type::all();
        // passo anche l'elenco di tutte le tecnologie utilizzate
        $technologies = Technology::all();
        // passo alla rotta edit sia il singolo progetto che tutte le tipologie disponibili per fare la scelta
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // memorizzo i dati del form
        $formData = $request->all();
        //richiamo la funzione per validare i dati e invirli al db
        $this->validation($request);

        if($request->hasFile('thumb')){
            if($project->thumb){
                // se il progetto ha già un'immagine allora la elimino
                Storage::delete($project->thumb);
            }

            // salvo la nuova immagine di copertina
            $path = Storage::put('project_images', $request->thumb);
            // modifico il campo thumb in modo che contenga solo la path
            $formData['thumb'] = $path;
        }

        // aggiorno i dati con la proprietà fillable definita nel Model
        // tranne per lo slug che creerò sulla base del titolo del progetto
        $formData['slug'] = Str::slug($formData['title'], '-');
        // funzione update per aggiornare i dati con i nuovi presenti nel formData (quindi dal form)
        $project->update($formData);

        // controllo se siste l'array delle tecnologie dal form
        if(array_key_exists('technologies', $formData)){
            $project->technologies()->sync($formData['technologies']);
        } else {
            $project->technologies()->detach();
        }

        // faccio il redirect alla show relativa al progetto modificato
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // controllo se il progetto ha un'immagine e nel caso la elimino dal mio storage
        if($project->thumb){
            Storage::delete($project->thumb);
        }

        //cancello il progetto
        $project->delete();

        //faccil il redirect alla pagina con tutti i progetti 
        return redirect()->route('admin.projects.index');
    }

    // creo una funzione che mi gestisca gli errori nei form
    private function validation($request){
        // richiamo i dati
        $formData = $request->all();

        // richiamo il Validator
        $validator = Validator::make($formData, [
            // inserisco le mie regole
            'title' => 'required|max:255|min:5',
            'content' => 'required|min:10',
            'thumb' => 'nullable|image|max:4096',    
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id',
        ], [
            // inserisco i messaggi personalizzati per ogni tipologia di errore per ogni campo
            'title.required' => "E' necessario inserire il titolo",
            'title.max' => "Il titolo non dev'essere superiore a :max caratteri",
            'title.min' => "Il titolo dev'essere di almeno :min caratteri",
            'content.required' => "E' necessario inserire la descrizione",
            'content.min' => "La descrizione dev'essere di almeno :min caratteri",
            'thumb.image' => "Il file inserito dev'essere un'immagine.",
            'thumb.max' => "La dimensione dell'immagine è troppo grande. ",
            // 'type_id.exists' => 'La tipologia deve essere presente',
            'technologies.exists' => 'La tegnologia deve essere presente',

        ])->validate();

        return $validator;
    }
}
