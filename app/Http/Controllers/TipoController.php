<?php

namespace Referentes\Http\Controllers;

use Illuminate\Http\Request;

use View;

use Referentes\Tipo;

class TipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $tipos = Tipo::all();
        return View::make('tipo.index')->with('tipos', $tipos);
    }

    public function create()
	{
       return view('tipo.create');
	}

	public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' =>	'required',
        ]);

        $input = $request->all();
        $tipo = Tipo::create($input);
        $tipo->save();

		return redirect('tipos')->withSuccess('Tipo ' . $tipo->nombre . ' creado.');
    }

    public function edit($id)
    {
        $tipo = Tipo::findOrFail($id);
        return View::make('tipo.edit')->with('tipo', $tipo);
    }

    public function update($id, Request $request){
        $input = $request->all();
        $tipo = Tipo::findOrFail($id);
        $this->validate($request, [
            'nombre' => 'required'
        ]);
        $tipo->update($input);
        return redirect('tipos')->withSuccess('Tipo ' . $tipo->nombre . ' actualizada.');
    }

    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);
        try {
            $tipo->delete();
            return redirect('tipos')->withSuccess('Tipo ' . $tipo->nombre . ' eliminado.');
        } catch (\Exception $e) {
            return redirect('tipos')->withError('Ese tipo de cambio está asignado a un cambio existente.');
        }
        return redirect('tipos');
    }
}
