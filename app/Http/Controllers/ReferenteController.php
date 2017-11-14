<?php

namespace Referentes\Http\Controllers;

use Illuminate\Http\Request;

use View;
use Auth;

use Referentes\Referente;

class ReferenteController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $referentes = Referente::all();
        return view('referente.index')->with('referentes', $referentes);
    }

    /**
	  * Show the form for creating a new resource.
	  *
	  * @return \Illuminate\Http\Response
	  */
	public function create()
	{
	   return view('referente.create');
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
            'informacion_enciclopedica'=>'required'
        ]);

        $input = $request->all();
        $referente = Referente::create($input);
        $referente->user_id = auth()->user()->id;        
        $referente->save();

        return redirect('/referentes')->with('success', 'Referente ' . $referente->nombre .' creado.');
    }

    public function show($id)
    {
        $referente = Referente::find($id);
        return view('referente.show')->with('referente', $referente);
    }

    public function edit($id)
    {
        $referente = Referente::find($id);
        return view('referente.edit')->with('referente', $referente);
    }

    public function update($id, Request $request){
		$input = $request->all();
		$referente = Referente::findOrFail($id);
		$this->validate($request, [
            'palabra'=>'required',
            'informacion_enciclopedica'=>'required'
        ]);
		$referente->update($input);
        return redirect('/referentes')->with('success', 'Referente ' . $referente->nombre .' editado.');
    }
    
    public function destroy($id)
    {
        $referente = Referente::find($id);
        foreach ($referente->cambios as $cambio) {
            $cambio->delete();
        }
        $referente->delete();
        return redirect('/referentes')->with('success', 'Referente ' . $referente->nombre .' eliminado.');
    }

    public function indexByUser()
	{
		$user_id = Auth::user()->id;
		$referentes = Referente::where('user_id', $user_id)->orderBy('updated_at', 'DESC')->get();
        return view('referente.user')->with('referentes', $referentes);
	}

}
