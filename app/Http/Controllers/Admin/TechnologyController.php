<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // richiamo la funzione per validare i dati prima di inviarli al db
      $this->validation($request);
      // richiamo tutti i dati presenti nel form
      $formData = $request->all();
      // creo il nuovo record per la tabella Type
      $newTech = new Technology();
      // popolo TUTTI i campi della tabella tranne lo slug che creerò con il nome
      $newTech->name = $formData['name'];
      $newTech->slug = Str::slug($formData['name'], '-');
      $newTech->color = $formData['color'];
      // salvo il record
      $newTech->save();

      // faccio il redirect alla pagina che mostra la singola tipologia nel dettaglio
      return redirect()->route('admin.technologies.show', $newTech);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        // passo alla rotta show (tecnologie nel dettaglio) il record di riferimento
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
      // passo alla rotta edit (modifica della singola tipologia) il record di riferimento
      return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
      //richiamo la funzione per validare i dati e invirli al db
      $this->validation($request);
      // memorizzo i dati del form
      $formData = $request->all();
      // aggiorno i dati 
      $formData['slug'] = Str::slug($formData['name'], '-');
      $technology->update($formData);
      // salvo il record
      $technology->save();

      // faccio il redirect alla show relativa al progetto modificato
      return redirect()->route('admin.technologies.show', $technology);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
      //cancello la tecnologia
      $technology->delete();

      //faccil il redirect alla pagina con tutti i progetti 
      return redirect()->route('admin.technologies.index');
    }

    // creo una funzione che mi gestisca gli errori nei form
    private function validation($request){
      // richiamo i dati
      $formData = $request->all();

      // richiamo il Validator
      $validator = Validator::make($formData, [
          // inserisco le mie regole
          'name' => 'unique:App\Models\Type,name|required|max:255|min:1',
          // 'color' => 'required|regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i',
      ], [
          // inserisco i messaggi personalizzati per ogni tecnologia di errore per ogni campo
          'name.unique' => "E' già presente una tecnologia con questo nome",
          'name.required' => "E' necessario inserire il nome",
          'name.max' => "Il nome non dev'essere superiore a :max caratteri",
          'name.min' => "Il nome dev'essere di almeno :min caratteri",
          // 'color.required' => "Il colore dev'essere indicato.",
          // 'color.regex' => "Devi indicare un valore esadecimale valido."

      ])->validate();

      return $validator;
  }
}
