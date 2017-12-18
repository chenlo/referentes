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
        /** Validar variantes required
        $rules = [];

        foreach($request->input('name') as $key => $value) {
            $rules["name.{$key}"] = 'required';
        }
        $validator = Validator::make($request->all(), $rules);
        */
        $input = $request->all();
        $referente = Referente::create($input);
        $referente->user_id = auth()->user()->id;        
        $referente->save();
        if(!empty($request->variantes[0])){
            foreach($request->variantes as $variante) {
                $referente->variantes()->create(['palabra' => $variante]);
            }
        }
        return redirect('/referentes')->with('success', 'Referente ' . $referente->palabra .' creado.');
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
        $referente->deleteVariantes();
        if(!empty($request->variantes[0])){
            $referente->updateVariantes($request->variantes);
        }

        $referente->update($input);
        
        return redirect('/referentes')->with('success', 'Referente ' . $referente->palabra .' editado.');
    }
    
    public function destroy($id)
    {
        $referente = Referente::find($id);
        $referente->deleteVariantes();
        $referente->deleteCambios();
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
