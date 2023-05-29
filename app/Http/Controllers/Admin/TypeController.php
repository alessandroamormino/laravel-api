<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create');
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
        $newType = new Type();
        // popolo TUTTI i campi della tabella tranne lo slug che creerò con il nome
        $newType->name = $formData['name'];
        $newType->slug = Str::slug($formData['name'], '-');
        $newType->description = $formData['description'];
        // salvo il record
        $newType->save();

        // faccio il redirect alla pagina che mostra la singola tipologia nel dettaglio
        return redirect()->route('admin.types.show', $newType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        // passo alla rotta show (tipologia nel dettaglio) il record di riferimento
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
      // passo alla rotta edit (modifica della singola tipologia) il record di riferimento
      return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
      //richiamo la funzione per validare i dati e invirli al db
      $this->validation($request);
      // memorizzo i dati del form
      $formData = $request->all();
      // aggiorno i dati 
      $formData['slug'] = Str::slug($formData['name'], '-');
      $type->update($formData);
      // salvo il record
      $type->save();

      // faccio il redirect alla show relativa al progetto modificato
      return redirect()->route('admin.types.show', $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
      //cancello il progetto
      $type->delete();

      //faccil il redirect alla pagina con tutti i progetti 
      return redirect()->route('admin.types.index');
    }

    // creo una funzione che mi gestisca gli errori nei form
    private function validation($request){
        // richiamo i dati
        $formData = $request->all();

        // richiamo il Validator
        $validator = Validator::make($formData, [
            // inserisco le mie regole
            'name' => 'unique:App\Models\Type,name|required|max:255|min:5',
            'description' => 'min:10',
        ], [
            // inserisco i messaggi personalizzati per ogni tipologia di errore per ogni campo
            'name.unique' => "E' già presente una tipologia con questo nome",
            'name.required' => "E' necessario inserire il nome",
            'name.max' => "Il nome non dev'essere superiore a :max caratteri",
            'name.min' => "Il nome dev'essere di almeno :min caratteri",
            'description.min' => "La descrizione dev'essere di almeno :min caratteri",

        ])->validate();

        return $validator;
    }
}
