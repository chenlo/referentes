<?php

namespace Referentes\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Referentes\Cambio;
use Referentes\Referente;
use Referentes\Lengua;
use Referentes\Tipo;
use Referentes\InicialCategoria;
use Referentes\FinalCategoria;

class CambioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
	  * Show the form for creating a new resource.
	  *
	  * @return \Illuminate\Http\Response
	  */
	public function create($id)
	{
        $referente = Referente::find($id);
        $lenguas = Lengua::pluck('nombre', 'id');
        $tipos = Tipo::pluck('nombre', 'id');
        $categorias_iniciales = InicialCategoria::pluck('palabra', 'id');
        $categorias_finales = FinalCategoria::pluck('palabra', 'id');
	    return view('cambio.create')->with('referente', $referente)->with('lenguas', $lenguas)->with('tipos', $tipos)->with('categorias_iniciales', $categorias_iniciales)->with('categorias_finales', $categorias_finales);
	}

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'palabra'=>'required',
            'tipo_id'=>'required',
            'lengua_id'=>'required',
            'inicial_categoria_id'=>'required_with:final_categoria_id',
            'final_categoria_id'=>'required_with:inicial_categoria_id',
            'anno_testimonio'=>'required_without:siglo',
            'siglo'=>'required_without:anno_testimonio|min:0|max:21'
        ]);
        
        $siglo = $request->input('siglo');
        if ($request->has('anno_testimonio')) {
            $siglo = intdiv($request->input('anno_testimonio'), 100) + 1;
        }
        $cambio = Cambio::create([
            'referente_id' => $request->input('referente_id'),
            'user_id' => auth()->user()->id,
            'lengua_id' => $request->input('lengua_id'),
            'tipo_id' => $request->input('tipo_id'),
            'palabra' => $request->input('palabra'),
            'anno_testimonio' => $request->input('anno_testimonio'),
            'siglo' => $siglo,
        ]);
        if(!empty($request->acepcions[0])){
            foreach($request->acepcions as $acepcion) {
                $cambio->acepcions()->create(['palabra' => $acepcion]);
            }
        }
        if( !empty($request->input('inicial_categoria_id')) && !empty($request->input('final_categoria_id')) ){
            $cambio->recategorizacion()->create([
                'inicial_categoria_id' => $request->input('inicial_categoria_id'),
                'final_categoria_id' => $request->input('final_categoria_id'),
            ]);
        }
    
        return view('referente.show')->with('referente', $cambio->referente)->with('success', 'Cambio ' . $request->input('palabra') .' añadido.');
    }

    public function edit($id)
    {
        $cambio = Cambio::findOrFail($id);
        $lenguas = Lengua::pluck('nombre', 'id');
        $tipos = Tipo::pluck('nombre', 'id');
        $categorias_iniciales = InicialCategoria::pluck('palabra', 'id');
        $categorias_finales = FinalCategoria::pluck('palabra', 'id');

        return view('cambio.edit')->with('cambio', $cambio)->with('lenguas', $lenguas)->with('tipos', $tipos)->with('categorias_iniciales', $categorias_iniciales)->with('categorias_finales', $categorias_finales);
    }

    public function update($id, Request $request){
        $input = $request->all();
        $cambio = Cambio::findOrFail($id);
        $this->validate($request, [
            'palabra'=>'required',
            'tipo_id'=>'required',
            'lengua_id'=>'required',
            'anno_testimonio'=>'required_without:siglo',
            'siglo'=>'required_without:anno_testimonio|min:0|max:21',
            'inicial_categoria_id'=>'required_with:final_categoria_id',
            'final_categoria_id'=>'required_with:inicial_categoria_id'
        ]);
        $siglo = $request->input('siglo');
        if ($request->has('anno_testimonio')) {
            $siglo = intdiv($request->input('anno_testimonio'), 100) + 1;
        }
        $input['siglo'] = $siglo;

        $cambio->recategorizacion()->update([
            'inicial_categoria_id' => $request->input('inicial_categoria_id'),
            'final_categoria_id' => $request->input('final_categoria_id'),
        ]);

        $cambio->update($input);

        $cambio->deleteAcepcions();        
        if(!empty($request->acepcions[0])){
            foreach($request->acepcions as $acepcion) {
                $cambio->acepcions()->create(['palabra' => $acepcion]);
            }
        }
        
        return redirect('cambios')->with('success', 'Cambio ' . $cambio->palabra .' editado.');
    }
    
    public function destroy($id)
    {
        $cambio = Cambio::findOrFail($id);
        $cambio->deleteAcepcions();
        $cambio->deleteRecategorizacion();
        $cambio->delete();
        return view('referente.show')->with('referente', $cambio->referente)->with('success', 'Cambio ' . $cambio->palabra .' eliminado.');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $cambios = Cambio::where('user_id', $user_id)->orderBy('updated_at', 'DESC')->get();
        return view('cambio.index')->with('cambios', $cambios);
    }
}
