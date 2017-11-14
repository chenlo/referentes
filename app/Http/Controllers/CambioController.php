<?php

namespace Referentes\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Referentes\Cambio;
use Referentes\Referente;
use Referentes\Lengua;
use Referentes\Tipo;

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
	    return view('cambio.create')->with('referente', $referente)->with('lenguas', $lenguas)->with('tipos', $tipos);
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
            'definicion'=>'required',
            'tipo_id'=>'required',
            'lengua_id'=>'required',
            'anno_testimonio'=>'required_without:siglo',
            'siglo'=>'required_without:anno_testimonio|min:0|max:21'
        ]);
        
        $siglo = $request->input('siglo');
        if ($request->has('anno_testimonio')) {
            $siglo = intdiv($request->input('anno_testimonio'), 100) + 1;
        }
        Cambio::create([
            'referente_id' => $request->input('referente_id'),
            'user_id' => auth()->user()->id,
            'lengua_id' => $request->input('lengua_id'),
            'tipo_id' => $request->input('tipo_id'),
            'palabra' => $request->input('palabra'),
            'definicion' => $request->input('definicion'),
            'anno_testimonio' => $request->input('anno_testimonio'),
            'siglo' => $siglo,
        ]);
        
        $referente = Referente::find($request->input('referente_id'));
        return view('referente.show')->with('referente', $referente)->with('success', 'Cambio ' . $request->input('palabra') .' añadido.');;
    }

    public function edit($id)
    {
        $cambio = Cambio::findOrFail($id);
        $lenguas = Lengua::pluck('nombre', 'id');
        $tipos = Tipo::pluck('nombre', 'id');
        return view('cambio.edit')->with('cambio', $cambio)->with('lenguas', $lenguas)->with('tipos', $tipos);
    }

    public function update($id, Request $request){
        $input = $request->all();
        $cambio = Cambio::findOrFail($id);
        $this->validate($request, [
            'palabra'=>'required',
            'definicion'=>'required',
            'tipo_id'=>'required',
            'lengua_id'=>'required',
            'anno_testimonio'=>'required_without:siglo',
            'siglo'=>'required_without:anno_testimonio|min:0|max:21'
        ]);
        $siglo = $request->input('siglo');
        if ($request->has('anno_testimonio')) {
            $siglo = intdiv($request->input('anno_testimonio'), 100) + 1;
        }
        $input['siglo'] = $siglo;

        $cambio->update($input);
        
        return redirect('cambios')->with('success', 'Cambio ' . $cambio->palabra .' editado.');
    }
    
    public function destroy($id)
    {
        $cambio = Cambio::findOrFail($id);
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
